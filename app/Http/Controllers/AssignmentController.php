<?php

namespace App\Http\Controllers;

use App\Contract\AssignmentContract;

class AssignmentController extends Controller
{

    protected AssignmentContract $service;

    public function __construct(AssignmentContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('assignment.index');
    }
}
