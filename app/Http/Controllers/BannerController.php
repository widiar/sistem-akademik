<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
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
        Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $banner->hashName()
        ]);
        $banner->storeAs('public/banner', $banner->hashName());
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
            Storage::disk('public')->delete('banner/' . $banner->image);
            $img->storeAs('public/banner', $img->hashName());
            $banner->image = $img->hashName();
            $banner->save();
        }
        return redirect()->route('admin.banner.index')->with(['success' => 'Berhasil update Banner']);
    }

    public function destroy(Banner $banner)
    {
        Storage::disk('public')->delete('banner/' . $banner->image);
        $banner->delete();
        return response()->json("Sukses");
    }
}
