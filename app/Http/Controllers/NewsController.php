<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::latest()->get();

        return view('news.index', compact('news'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $news  = new News();
        if ($request->file('image') == null) {
            $image = '';
        } else {
            $image = $request->file('image')->store('news', ['disk' => 'public']);
        }
        $news->title = $request->get('title');
        $news->excerpt = $request->get('excerpt');
        $news->author_id = Auth::user()->id;
        $news->body = $request->get('body');
        $news->image = $image;

        $news->save();

        return redirect()->back()->with('success', 'News added successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        if (!$news) {
            return redirect()->back()->with('warning', 'The News you wanted to edit does not exist.');
        }

        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news = News::find($id);
        $this->validate($request, [
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);
        if ($request->file('image') == null) {
            $image = '';
        } else {
            $news->image != null ? Storage::delete($news->image) : null;
            $image = $request->file('image')->store('news', ['disk' => 'public']);
        }
        $news->title = $request->get('title');
        $news->excerpt = $request->get('excerpt');
        $news->body = $request->get('body');
        $news->image = $image;

        $news->save();
        return redirect()->action('NewsController@index')->with('success', 'News updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        if ($news) {
            $news->image != null ? Storage::delete($news->image) : null;
            $news->delete();
        }

        return redirect()->action('NewsController@index')->with('success', 'News deleted successfully');
    }

}
