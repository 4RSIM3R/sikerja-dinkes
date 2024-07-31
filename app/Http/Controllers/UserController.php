<?php

namespace App\Http\Controllers;

use App\Contract\UserContract;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected UserContract $service;

    public function __construct(UserContract $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return view('user.index');
    }

    public function grid(Request $request)
    {
      $page = $request->get('page', 1);
      $perPage = $request->get('perPage', 10); 

      $data = $this->service->all(page: $page, dataPerPage: $perPage, paginate: true);
      return response()->json($data);
    }

}
