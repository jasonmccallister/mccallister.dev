<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(ContentRepository $content): View
    {
        $page = $content->page('about');

        if ($page === null) {
            abort(404);
        }

        return view('pages.about', [
            'page' => $page,
        ]);
    }

    public function appearances(ContentRepository $content): View
    {
        $page = $content->page('appearances');

        if ($page === null) {
            abort(404);
        }

        return view('pages.appearances', [
            'page' => $page,
        ]);
    }
}
