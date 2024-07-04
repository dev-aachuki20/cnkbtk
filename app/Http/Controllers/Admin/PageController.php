<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function edit($title)
    { 
        $pageRecord = Page::where('title', $title)->get()->toArray();
        return view('admin.page.edit', compact('title', 'pageRecord'));
    }

    public function update(Request $request, $title)
    {
        $request->validate([
            'content_en' => 'required|string',
            'content_ch' => 'required|string',
        ],[],[
            'content_en' => trans("cruds.pages.fields.content_en"),
            'content_ch'  => trans("cruds.pages.fields.content_ch"),
        ]);

        $page = Page::where('title', $title)->firstOrFail();
        $page->content_en = $request->input('content_en');
        $page->content_ch = $request->input('content_ch');
        $page->save();

        $notification = array(
            'message' => trans("messages.update_success",['module' => trans("cruds.pages.update_message")]),
            'alert-type' =>'success' 
        );
    
        return redirect()->route('admin.pages.edit', $title)->with($notification);
    }

    public function show($title)
    {
        $page = Page::where('title', $title)->firstOrFail();
        return view('condition-page', compact('page'));
    }
}
