<?php

namespace App\Http\Controllers;

use App\Contract\AppSettingContract;
use App\Contract\WebSettingContract;
use App\Http\Requests\Web\AppSettingRequest;
use App\Http\Requests\Web\WebSettingRequest;
use App\Models\AppSetting;
use App\Models\WebSetting;
use Exception;

class SettingController extends Controller
{

    protected WebSettingContract $webSetting;
    protected AppSettingContract $appSetting;

    public function __construct(WebSettingContract $webSetting, AppSettingContract $appSetting)
    {
        $this->webSetting = $webSetting;
        $this->appSetting = $appSetting;
    }

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

    public function web_update(WebSettingRequest $request)
    {
        $payload = $request->validated();
        $banner = ["banner" => $request->file('banner')];
        unset($payload['banner']);

        $result = $this->webSetting->createOrUpdateFirst($payload, $banner);

        if ($result instanceof Exception) {
            return redirect()->back()->withErrors($result->getMessage());
        } else {
            return redirect()->route('setting.web');
        }
    }

    public function app_update(AppSettingRequest $request)
    {
        $payload = $request->validated();
        $banner = ["banner" => $request->file('banner')];
        unset($payload['banner']);

        $result = $this->webSetting->createOrUpdateFirst($payload, $banner);

        if ($result instanceof Exception) {
            return redirect()->back()->withErrors($result->getMessage());
        } else {
            return redirect()->route('setting.app');
        }
    }
}
