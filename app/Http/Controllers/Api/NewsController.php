<?php

namespace App\Http\Controllers\Api;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use http\Env\Response;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::select('id', 'title', 'excerpt','body', 'image', 'created_at')->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $news
        ]);
    }


    public function recent()
    {
        $news = News::latest()->select('id', 'title', 'excerpt', 'image')->whereNotNull('image')->take(5)->get();

        return response()->json([
            'success' => true,
            'data' => $news
        ]);
    }



    public function show($id)
    {
        $news = News::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $news
        ]);
    }
}
