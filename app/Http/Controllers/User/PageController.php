<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($title)
    {
        $page = Page::where('title', $title)->firstOrFail();
        return view('pages.show', compact('page'));
    }

    public function edit($title)
    {
        $page = Page::where('title', $title)->firstOrFail();
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, $title)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $page = Page::where('title', $title)->firstOrFail();
        $page->content = $request->input('content');
        $page->save();

        return redirect()->route('pages.show', $title)->with('success', 'Page updated successfully');
    }
}
