<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\SiteTown;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewHelper;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $latest_blogs = array();
        $available_tags = array();
        
        if (!app()->runningInConsole()) {
            try {
                // Check if database tables exist before querying
                if (Schema::hasTable('blogs')) {
                    $latest_blogs = Blog::query()->latest()->limit(3)->get();
                }
                if (Schema::hasTable('site_towns')) {
                    $available_tags = SiteTown::where("town", "!=", "")->select("town")->pluck("town")->toArray();
                }
            } catch (\Exception $e) {
                // Log the error but don't break the application
                \Illuminate\Support\Facades\Log::warning('ViewServiceProvider boot error: ' . $e->getMessage());
            }
        }
        
        View::composer(['layouts.app', 'layouts.user_profile_app'], function (ViewHelper $view) use ($latest_blogs) {
            // Ensure $latest_blogs is always an array or collection
            $view->with('latest_blogs', $latest_blogs ?? []);
        });
        
        View::composer(['auth.register', 'employer.edit-profile', 'employer.manage-store', 'freelancer.edit-profile'], function (ViewHelper $view) use ($available_tags) {
            // Ensure $available_tags is always an array
            $view->with('site_towns_available_tags', $available_tags ?? []);
        });
        
        // Ensure $errors is always available in all views
        View::composer('*', function (ViewHelper $view) {
            try {
                $errors = $view->getData()['errors'] ?? null;
                if (!$errors || !is_object($errors)) {
                    $view->with('errors', session()->get('errors', new \Illuminate\Support\ViewErrorBag()));
                }
            } catch (\Exception $e) {
                // If anything fails, just set empty error bag
                $view->with('errors', new \Illuminate\Support\ViewErrorBag());
            }
        });
    }
}