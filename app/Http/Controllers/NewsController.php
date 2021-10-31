<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ImageKit\ImageKit;

class NewsController extends Controller
{

    protected function imageKit()
    {
        return new ImageKit(
            env('IMAGE_KIT_PUBLIC_KEY'),
            env('IMAGE_KIT_SECRET_KEY'),
            env('IMAGE_KIT_ENDPOINT')
        );
    }

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
            if (env('APP_ENV') == 'local') {
                $news->poster = $poster->hashName();
                $poster->storeAs('public/news', $poster->hashName());
            } else {
                $imageKit = $this->imageKit();
                $uploadFile = $imageKit->upload([
                    'file' => fopen($poster->getPathname(), "r"),
                    'fileName' => $poster->hashName(),
                    'folder' => "sistem-akademik//news//"
                ]);
                $news->poster = json_encode([
                    "field" => $uploadFile->success->fileId,
                    "url" => $uploadFile->success->url,
                ]);
            }
            $news->save();
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
            if ($news->poster) {
                if (env('APP_ENV') == 'local') Storage::disk('public')->delete('news/' . $news->poster);
                else {
                    $imageKit = $this->imageKit();
                    $imageKit->deleteFile(json_decode($news->poster)->field);
                }
            }
            if (env('APP_ENV') == 'local') {
                $img->storeAs('public/news', $img->hashName());
                $news->poster = $img->hashName();
            } else {
                $imageKit = $this->imageKit();
                $uploadFile = $imageKit->upload([
                    'file' => fopen($img->getPathname(), "r"),
                    'fileName' => $img->hashName(),
                    'folder' => "sistem-akademik//news//"
                ]);
                $news->poster = json_encode([
                    "field" => $uploadFile->success->fileId,
                    "url" => $uploadFile->success->url,
                ]);
            }
            $news->save();
        }
        return redirect()->route('admin.news.index')->with(['success' => 'Berhasil update berita']);
    }

    public function destroy(News $news)
    {
        if ($news->poster) {
            if (env('APP_ENV') == 'local') Storage::disk('public')->delete('news/' . $news->poster);
            else {
                $imageKit = $this->imageKit();
                $imageKit->deleteFile(json_decode($news->poster)->field);
            }
        }
        $news->delete();
        return response()->json('Sukses');
    }
}
