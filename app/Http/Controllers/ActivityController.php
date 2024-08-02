<?php

namespace App\Http\Controllers;

use App\Contract\ActivityContract;
use App\Http\Requests\Web\ActivityWebRequest;
use App\Models\Activity;
use Exception;
use Illuminate\Http\Request;
use App\Http\Resources\ActivityResource;

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
            relations: ['assignment'],
            relationCount: ['attendances'],
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
        $payload = $request->validated();

        $result = $this->service->create($payload);

        if ($result instanceof Exception) {
            return redirect()->back()->withErrors($result->getMessage());
        } else {
            return redirect()->route('activity.index');
        }
    }

    public function delete( Activity $activity, $id) {
        $deleted_data = Activity::findOrFail($id);

        $deleted_data->forceDelete();

        return response()->json($deleted_data);
    }

    public function restore(Activity $activity, $id) {
        $restore_data = Activity::withTrashed()->where('id', $id)->restore();

        $restore_data->restore();
        return response()->json($restore_data);
    }

    public function showDeletedData(Activity $activity) {
        $deletedRecords = Activity::withTrashed()->get();
        return view('activity.index', compact('deletedRecords'));
    }

    public function forceDelete(Activity $activity, $id) {
        $force_delete = Activity::withTrashed()->where('id', $id)->forceDelete();
            
        return response()->json($force_delete);
    }
}
