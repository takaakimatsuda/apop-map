<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tag;
use App\Models\Region;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // イベント一覧表示
    public function index()
    {
        $tags = Tag::all();
        $regions = Region::all();
        $categories = Category::all();

        // ログインしている場合は登録ユーザーのみのイベントも表示、していない場合は全公開のみ
        $events = Event::with('tags')
            ->where(function ($query) {
                if (auth()->check()) {
                    // ログイン済みユーザーは visibility >= 1 のイベントを表示
                    $query->where('visibility', '>=', 1);
                } else {
                    // 未ログインユーザーは visibility = 2 (全公開) のイベントのみ表示
                    $query->where('visibility', 2);
                }
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(24);

        return view('events.index', compact('events', 'tags', 'regions', 'categories'));
    }

    // イベント作成フォームの表示
    public function create()
    {
        $tags = Tag::all();
        $regions = Region::all();
        $categories = Category::all();
        return view('events.create', compact('tags', 'regions', 'categories'));
    }

    // 新しいイベントの保存
    public function store(Request $request)
    {
        \Log::info('イベント登録リクエスト:', $request->all());
            // バリデーションルールの定義
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',  // イベント名は必須
                'category_id' => 'required|array',  // カテゴリーは配列で、少なくとも1つ選択されている必要がある
            'date' => 'nullable|date',  // その他のフィールドは任意
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'venue_name' => 'nullable|string|max:255',
            'venue_address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'reference_url' => 'nullable|url',
            'region_id' => 'nullable|exists:regions,region_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 画像のバリデーション追加
            'visibility' => 'required|integer|in:0,1,2',
        ],[
            'title.required' => 'イベント名は必須です。',
            'category_id.required' => 'カテゴリーを選択してください。',
        ]);

        // イベントの作成
        $event = new Event($validatedData);
        $event->user_id = auth()->id(); // ログインユーザーのIDを設定

        if ($request->hasFile('image')) {
            // アップロードされた画像を取得
            $file = $request->file('image');

            // 画像をリサイズ
            $image = Image::make($file)->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();  // アスペクト比を保持
                    $constraint->upsize();  // サイズを超えないようにする
                })->encode();  // 画像データをエンコード

            // リサイズした画像をS3に保存
            $imagePath = 'events/' . $file->hashName();  // ファイル名を生成
            Storage::disk('s3')->put($imagePath, (string) $image);

            // S3のURLを取得してデータベースに保存
            $event->image_url = Storage::disk('s3')->url($imagePath);
        }

        $event->save();

        // カテゴリーの関連付け
        $event->categories()->sync($request->category_id);

        // 成功メッセージと共にイベント一覧にリダイレクト
        return redirect()->route('events.index')->with('success', 'イベントが正常に作成されました。');
    }

    // イベント詳細の表示
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    // イベント編集フォームの表示
    public function edit(Event $event)
    {
        $tags = Tag::all();
        $regions = Region::all();  // 地域情報を取得
        $categories = Category::all();  // カテゴリも取得する場合

        return view('events.edit', compact('event', 'tags', 'regions', 'categories'));
    }

    // イベントの更新
    public function update(Request $request, Event $event)
    {
        // デバッグ用に渡されたデータを確認
        \Log::info('更新データ: ', $request->all());
        // バリデーションルールの定義
        $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|array',
                'date' => 'nullable|date',
                'start_time' => 'nullable|date_format:H:i:s',
                'end_time' => 'nullable|date_format:H:i:s',
                'venue_name' => 'nullable|string|max:255',
                'venue_address' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'reference_url' => 'nullable|url',
                'region_id' => 'nullable|exists:regions,region_id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'visibility' => 'required|integer|in:0,1,2',
            ], [
                'title.required' => 'イベント名は必須です。',
                'category_id.required' => 'カテゴリーを選択してください。',
            ]);

        // イベントの更新
        $event->fill($validatedData);

        // 画像ファイルがある場合、S3にアップロード
        if ($request->hasFile('image')) {
            // 既存の画像を削除
            if ($event->image_url) {
                $parsedUrl = parse_url($event->image_url);
                $path = ltrim($parsedUrl['path'], '/');
                Storage::disk('s3')->delete($path);
            }

            // 新しい画像をアップロード
            $imagePath = $request->file('image')->store('events', 's3');
            $event->image_url = Storage::disk('s3')->url($imagePath);
        }

        $event->save();

        // 保存後のイベントデータをデバッグログに出力
        \Log::info('保存後のイベントデータ: ', $event->toArray());

        // タグの更新
        if ($request->has('tags')) {
            $event->tags()->sync($request->tags);
        }

        // カテゴリーの更新
        if ($request->has('category_id')) {
            $event->categories()->sync($request->category_id);
        }

        // 更新後にイベント管理画面にリダイレクト
        return redirect()->route('events.my')->with('success', 'イベントが正常に更新されました。');
    }

    // イベントの削除
    public function destroy(Event $event)
    {
        $event->tags()->detach();
        $event->delete();

        return redirect()->route('events.my')->with('success', 'イベントが正常に削除されました。');
    }

    public function myEvents()
    {
        // ログインユーザーのイベントのみを取得し、updated_atで降順に並べ替え
        $user = auth()->user();
        $events = $user->events()
            ->with('categories', 'tags', 'region')
            ->orderBy('updated_at', 'desc')
            ->paginate(12);

        return view('events.my_events', compact('events'));
    }

}
