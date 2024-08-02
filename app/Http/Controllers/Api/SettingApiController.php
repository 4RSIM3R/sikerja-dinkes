<?php

namespace App\Http\Controllers\Api;

use App\Contract\AppSettingContract;
use App\Http\Controllers\Controller;

class SettingApiController extends Controller
{

    protected AppSettingContract $service;

    public function __construct(AppSettingContract $service)
    {
        $this->service = $service;
    }
}
