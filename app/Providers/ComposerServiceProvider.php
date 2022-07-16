<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer(['Admin::layouts.admin', 'User::layouts.lp', 'User::layouts.frontend', 'User::layouts.user'], function ($view) {
            // $setting = Setting::pluck('value', 'key');

            $globalData = [
                // 'setting' => $setting,
            ];
            $view->with('globalData', $globalData);
        });
    }

    public function register()
    {
    }
}
