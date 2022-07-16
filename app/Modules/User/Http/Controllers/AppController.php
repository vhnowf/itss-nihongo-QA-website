<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class AppController extends Controller
{
    public function getMeta()
    {
        // $setting = Setting::pluck('value', 'key');
        // $setting['link_facebook'] = isset($setting['link_facebook']) ? $setting['link_facebook'] : null;
        // $setting['link_instagram'] = isset($setting['link_instagram']) ? $setting['link_instagram'] : null;
        // $setting['phone_number'] = isset($setting['phone_number']) ? $setting['phone_number'] : null;

        // View::share('setting', $setting);

        // return [
        //     'robots' => 'index,follow',
        //     'title' => $setting['seo_title'] ?? 'Vinavi',
        //     'keywords' => $setting['seo_keywords'] ?? 'Vinavi',
        //     'description' => $setting['seo_description'] ?? 'Vinavi',
        //     'favicon' => asset($setting['favicon'] ?? 'favicon.png'),
        //     'og_image' => asset($setting['og_image'] ?? 'favicon.png'),
        // ];
    }
}
