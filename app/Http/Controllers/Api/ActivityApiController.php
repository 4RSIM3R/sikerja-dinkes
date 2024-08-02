<?php

namespace App\Http\Controllers\Api;

use App\Contract\ActivityContract;
use App\Http\Controllers\Controller;

class ActivityApiController extends Controller
{
    protected ActivityContract $service;

    public function __construct(ActivityContract $service)
    {
        $this->service = $service;
    }
}
