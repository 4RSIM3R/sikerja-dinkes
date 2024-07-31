<?php 

namespace App\Http\Controllers;

use App\Contract\ActivityContract;

class ActivityController extends Controller
{

    protected ActivityContract $service;

    public function __construct(ActivityContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('activity.index');
    }

}