<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // イベント一覧表示
    public function index()
    {
        $events = Event::with('tags')->get();
        return view('events.index', compact('events'));
    }

    // イベント作成フォームの表示
    public function create()
    {
        $tags = Tag::all();
        return view('events.create', compact('tags'));
    }

    // 新しいイベントの保存
    public function store(Request $request)
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

        // イベントの作成と保存
        $event = Event::create($validatedData);

        // タグの関連付け
        if ($request->has('tags')) {
            $event->tags()->sync($request->tags);
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
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
