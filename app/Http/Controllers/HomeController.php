<?php 

namespace App\Http\Controllers;

use App\Models\WebSetting;

class HomeController extends Controller
{

    public function index()
    {
        $setting = WebSetting::query()->first();
        return view('welcome', compact('setting'));
    }

}