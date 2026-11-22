<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use App\Support\Seo;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function show(string $slug, ContentRepository $content): View
    {
        $page = $content->page($slug);

        if ($page !== null) {
            $view = view()->exists("pages.{$slug}")
                ? "pages.{$slug}"
                : 'pages.show';

            return view($view, [
                'page' => $page,
                'seo' => Seo::forPage($page),
            ]);
        }

        $post = $content->post($slug);

        if ($post !== null) {
            return view('posts.show', [
                'post' => $post,
                'seo' => Seo::forPost($post),
            ]);
        }

        abort(404);
    }
}
