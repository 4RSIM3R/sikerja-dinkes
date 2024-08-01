<?php

namespace App\Http\Controllers;

use App\Contract\ActivityContract;
use App\Http\Requests\Web\ActivityWebRequest;
use Illuminate\Http\Request;

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

    public function grid(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = $request->get('perPage', 10);
        $search = $request->get("search");
        $where = $search ? [["title", "like", "%" . $search . "%"]] : [];

        $data = $this->service->all(
            page: $page,
            dataPerPage: $perPage,
            paginate: true,
            relations: ['roles'],
            whereConditions: $where,
        );
        return response()->json($data);
    }

    public function form()
    {
        return view('activity.form');
    }

    public function store(ActivityWebRequest $request)
    {
    }
}
