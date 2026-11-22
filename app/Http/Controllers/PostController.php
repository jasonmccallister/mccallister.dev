<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use Illuminate\View\View;

class PostController extends Controller
{
    public function show(string $slug, ContentRepository $content): View
    {
        $post = $content->post($slug);

        if ($post === null) {
            abort(404);
        }

        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
