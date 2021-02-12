<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Media\News\News;
use App\Services\Api\Media\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index()
    {
        return view('site.pages.news', [
            'news' => News::all()
        ]);
    }

    public function show($slug)
    {
        return view('site.pages.currentNews',
            ['news' => News::where('slug', $slug)->firstOrFail()]
        );
    }
}
