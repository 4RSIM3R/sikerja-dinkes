<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\WebSetting;

class SettingController extends Controller
{

    public function web_index()
    {
        $setting = WebSetting::query()->first();
        return view('setting.web', compact('setting'));
    }

    public function app_index()
    {
        $setting = AppSetting::query()->first();
        return view('setting.app', compact('setting'));
    }

    public function web_update(WebSetting $setting)
    {
    }

    public function app_update(WebSetting $setting)
    {
    }
}
