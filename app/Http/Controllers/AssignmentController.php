<?php

namespace App\Http\Controllers;

use App\Contract\AssignmentContract;
use App\Http\Requests\Web\AssignmentWebRequest;
use Exception;
use Illuminate\Http\Request;

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

    public function grid(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = $request->get('perPage', 10);
        $search = $request->get("search");
        $where = $search ? [["number", "like", "%" . $search . "%"]] : [];

        $data = $this->service->all(
            page: $page,
            dataPerPage: $perPage,
            paginate: true,
            whereConditions: $where,
        );
        return response()->json($data);
    }

    public function form()
    {
        return view('assignment.form');
    }

    public function store(AssignmentWebRequest $request)
    {
        $attachment = $request->file('attachment');
        $payload = $request->validated();
        unset($payload['attachment']);

        $result = $this->service->create($payload, $attachment);

        if ($result instanceof Exception) {
            return redirect()->back()->withErrors($result->getMessage());
        } else {
            return redirect()->route('assignment.index');
        }
    }
}
