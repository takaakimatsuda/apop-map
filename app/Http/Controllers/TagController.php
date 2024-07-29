<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagStoreRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tag $tag)
    {
        $tags = Tag::all();
        return view('pages.tag.list', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagStoreRequest $request)
    {
        // バリデーションは自動的に行われる
        // バリデーションが成功した後の処理
        $validatedData = $request->validated();

        // tagsテーブルにデータをINSERT
        $tag = Tag::create([
            'name' => $validatedData['name'],
        ]);
        // 必要に応じてリダイレクトやレスポンスを追加
        return redirect()->back()->with('success', 'Tag created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
        dump($tag->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
