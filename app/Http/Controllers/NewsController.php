<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('updated_at', 'desc')->get();
        return view('admin.pemasaran.news', compact('news'));
    }

    public function create()
    {
        return view('admin.pemasaran.addNews');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'poster' => 'image|mimes:png,jpeg|max:5120'
        ]);
        $news = News::create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title, '-')
        ]);
        $poster = $request->poster;
        if ($poster) {
            $news->poster = $poster->hashName();
            $news->save();
            $poster->storeAs('public/news', $poster->hashName());
        }
        return redirect()->route('admin.news.index')->with(['success' => 'Berhasil menambah berita']);
    }

    public function show($id)
    {
        //
    }

    public function edit(News $news)
    {
        return view('admin.pemasaran.editNews', compact('news'));
    }

    public function update(News $news, Request $request)
    {
        $news->title = $request->title;
        $news->content = $request->content;
        $news->save();
        $img = $request->file('poster');
        if ($img) {
            if ($news->poster) Storage::disk('public')->delete('news/' . $news->poster);
            $img->storeAs('public/news', $img->hashName());
            $news->poster = $img->hashName();
            $news->save();
        }
        return redirect()->route('admin.news.index')->with(['success' => 'Berhasil update berita']);
    }

    public function destroy(News $news)
    {
        if ($news->poster) Storage::disk('public')->delete('news/' . $news->poster);
        $news->delete();
        return response()->json('Sukses');
    }
}
