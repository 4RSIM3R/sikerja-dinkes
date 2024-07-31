<?php

namespace App\Http\Controllers;

use App\Contract\UserContract;
use App\Http\Requests\Web\UserWebRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $search = $request->get("search");
        $where = $search ? [["name", "like", "%" . $search . "%"]] : [];

        $data = $this->service->all(
            page: $page,
            dataPerPage: $perPage,
            paginate: true,
            relations: ['roles'],
            whereConditions: $where,
        );
        return response()->json($data);
    }

    public function form(Request $request)
    {
        return view('user.form');
    }

    public function store(UserWebRequest $request)
    {
        $payload = $request->validated();
        $payload['password'] = Hash::make($payload['password']);

        $result = $this->service->create($payload);

        if ($result instanceof Exception) {
            return redirect()->back()->withErrors($result->getMessage());
        } else {
            return redirect()->route('user.index');
        }
    }

    public function detail($id)
    {
        return view('user.detail');
    }

    public function update($id, UserWebRequest $request)
    {
        $payload = $request->validated();
        $result = $this->service->update($id, $payload);

        if ($result instanceof Exception) {
            return redirect()->back()->withErrors($result->getMessage());
        } else {
            return redirect()->route('user.index');
        }
    }

    public function destroy($id)
    {
        $result = $this->service->delete($id);

        if ($result instanceof Exception) {
            return redirect()->back()->withErrors($result->getMessage());
        } else {
            return redirect()->route('user.index');
        }
    }
}
