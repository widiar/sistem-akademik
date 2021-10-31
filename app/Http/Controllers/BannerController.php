<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
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
        $banner = Banner::all();
        return view('admin.pemasaran.banner', compact('banner'));
    }

    public function create()
    {
        return view('admin.pemasaran.addBanner');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'banner' => 'required|image|mimes:png,jpeg|max:5120'
        ]);
        $banner = $request->banner;
        if (env('APP_ENV') == 'local') {
            Banner::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $banner->hashName()
            ]);
            $banner->storeAs('public/banner', $banner->hashName());
        } else {
            $imageKit = $this->imageKit();
            $uploadFile = $imageKit->upload([
                'file' => fopen($banner->getPathname(), "r"),
                'fileName' => $banner->hashName(),
                'folder' => "sistem-akademik//banner//"
            ]);
            Banner::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => json_encode([
                    "field" => $uploadFile->success->fileId,
                    "url" => $uploadFile->success->url,
                ])
            ]);
        }
        return redirect()->route('admin.banner.index')->with(['success' => 'Berhasil menambah Banner']);
    }

    public function show($id)
    {
        //
    }

    public function edit(Banner $banner)
    {
        return view('admin.pemasaran.editBanner', compact('banner'));
    }

    public function update(Banner $banner, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->save();
        $img = $request->file('banner');
        if ($img) {
            if (env('APP_ENV') == 'heroku') {
                $imageKit = $this->imageKit();
                $uploadFile = $imageKit->upload([
                    'file' => fopen($img->getPathname(), "r"),
                    'fileName' => $img->hashName(),
                    'folder' => "sistem-akademik//banner//"
                ]);
                if ($banner->image) {
                    if (json_decode($banner->image)->field) {
                        $imageKit = $this->imageKit();
                        $imageKit->deleteFile(json_decode($banner->image)->field);
                    }
                }
                $banner->image = json_encode([
                    "field" => $uploadFile->success->fileId,
                    "url" => $uploadFile->success->url,
                ]);
            } else {
                Storage::disk('public')->delete('banner/' . $banner->image);
                $img->storeAs('public/banner', $img->hashName());
                $banner->image = $img->hashName();
            }
            $banner->save();
        }
        return redirect()->route('admin.banner.index')->with(['success' => 'Berhasil update Banner']);
    }

    public function destroy(Banner $banner)
    {
        if (env('APP_ENV') == 'local') {
            Storage::disk('public')->delete('banner/' . $banner->image);
        } else {
            $imageKit = $this->imageKit();
            $imageKit->deleteFile(json_decode($banner->image)->field);
        }
        $banner->delete();
        return response()->json("Sukses");
    }
}
