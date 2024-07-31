<?php 

namespace App\Http\Controllers;

use App\Contract\ReimbursementContract;

class ReimburseController extends Controller
{

    protected ReimbursementContract $service;

    public function __construct(ReimbursementContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        // return view('reimburse.index');
    }

}