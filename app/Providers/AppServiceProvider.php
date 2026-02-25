<?php

namespace App\Providers;
use App\Models\Faq;
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
    View::composer('web.home', function ($view) {
        $view->with(
            'faqs',
            Faq::where('is_active', true)
                ->orderBy('sort_order')
                ->get()
        );
    });
}
}
