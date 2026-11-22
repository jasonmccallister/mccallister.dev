<?php

namespace App\Providers;

use App\Support\Seo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('errors.404', function ($view): void {
            $view->with('seo', [
                'title' => 'Page not found | '.config('site.name'),
                'description' => 'Page not found',
                'type' => 'website',
                'image' => Seo::absoluteImage(config('site.default_og_image')),
                'canonical' => url()->current(),
                'jsonLd' => [],
            ]);
        });
    }
}
