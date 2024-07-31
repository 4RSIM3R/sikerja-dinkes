<?php 

namespace App\Http\Controllers;

use App\Contract\AttendanceContract;

class AttendanceController extends Controller
{

    protected AttendanceContract $service;

    public function __construct(AttendanceContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        // return view('attendance.index');
    }

}