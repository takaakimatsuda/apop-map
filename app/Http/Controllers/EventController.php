<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tag;
use App\Models\Region;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // イベント一覧表示
    public function index()
    {
        // 1ページあたり24件のイベントを取得し、ページングを行う
        $events = Event::with('tags')->orderBy('updated_at', 'desc')->paginate(24);
        return view('events.index', compact('events'));
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
        // バリデーションルールの定義
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',  // イベント名は必須
            'category_id' => 'required|array',  // カテゴリーは配列で、少なくとも1つ選択されている必要がある
            'date' => 'nullable|date',  // その他のフィールドは任意
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'venue_name' => 'nullable|string|max:255',
            'venue_address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'reference_url' => 'nullable|url',
            'region' => 'nullable|exists:regions,region_id',
        ],[
            'title.required' => 'イベント名は必須です。',
            'category_id.required' => 'カテゴリーを選択してください。',
        ]);

        // イベントの作成
        $event = new Event($validatedData);
        $event->user_id = auth()->id(); // ログインユーザーのIDを設定
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
        return view('events.edit', compact('event', 'tags'));
    }

    // イベントの更新
    public function update(Request $request, Event $event)
    {
        // バリデーション
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'venue_name' => 'nullable|string|max:255',
            'venue_address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // イベントの更新
        $event->update($validatedData);

        // タグの更新
        if ($request->has('tags')) {
            $event->tags()->sync($request->tags);
        }

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    // イベントの削除
    public function destroy(Event $event)
    {
        $event->tags()->detach();
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
