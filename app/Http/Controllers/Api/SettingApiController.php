<?php

namespace App\Http\Controllers\Api;

use App\Contract\AppSettingContract;
use App\Http\Controllers\Controller;
use App\Utils\WebResponseUtils;
use Illuminate\Http\Request;

class SettingApiController extends Controller
{

    protected AppSettingContract $service;

    public function __construct(AppSettingContract $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $data = $this->service->findById(1);
        return WebResponseUtils::response($data);
    }
}
