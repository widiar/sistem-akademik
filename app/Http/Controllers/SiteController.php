<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class SiteController extends Controller
{
    public function index()
    {
        $banner = Banner::all();
        $news = News::orderBy('updated_at', 'desc')->skip(0)->take(5)->get();
        return view('home', compact('banner', 'news'));
    }

    public function news($slug)
    {
        $news = News::where('slug', $slug)->first();
        return view('news', compact('news'));
    }

    public function allNews()
    {
        $news = News::orderBy('updated_at', 'desc')->paginate(10);
        return view('listNews', compact('news'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function dev()
    {
        $pdf = PDF::loadView('pdf');
        $pdf->setOption('header-html', view('header'));
        return $pdf->stream();
        return view('pdf');
    }
}
