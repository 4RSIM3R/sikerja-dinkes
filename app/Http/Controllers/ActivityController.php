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

    public function destroy($id)
    {

        //check if have an id
        $assignment = Activity::findOrFail($id);

        //SoftDeletes
        $assignment->delete();

        //return 
        return response()->json([
            'success' => true,
            'message' => 'Assignment has been deleted succesfuly'
        ]);
    }

    //restore deleted data
    public function restore(Request $request, $id)
    {
        //get deleted data with id
        $assignment_restore = Activity::onlyTrashed()->findOrFail($id);
        //restoring data
        $assignment_restore->restore();

        return response()->json([
            'success' => true,
            'message' => 'Restore Data succesfuly',
            'data' => $assignment_restore
        ]);
    }

    //show deleted data
    public function trash(Request $request)
    {

        return view('Activity.trash');
    }

    public function deleted(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = $request->get('perPage', 10);
        $search = $request->get("search");
        $where = $search ? [["number", "like", "%" . $search . "%"]] : [];

        // Mengambil data yang telah dihapus dengan onlyTrashed
        $deleted_assignment = Activity::onlyTrashed()
            ->where($where)
            ->paginate($perPage, ['*'], 'page', $page);
        return response()->json($deleted_assignment);
    }

    //force delete data
    public function forceDelete($id)
    {
        $force_delete_assignment = Activity::withTrashed()->findOrFail($id);
        $force_delete_assignment->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Assignment has been permanently deleted successfully!'
        ]);
    }
}
