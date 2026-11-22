<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(ContentRepository $content): View
    {
        $posts = $content->posts();
        $featuredPosts = $content->featuredPosts();
        $latestPosts = $posts->reject(fn ($post) => $post->featured)->values();

        return view('home', [
            'featuredPosts' => $featuredPosts,
            'latestPosts' => $latestPosts,
        ]);
    }
}
