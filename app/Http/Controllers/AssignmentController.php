<?php

namespace App\Http\Controllers;

use App\Contract\AssignmentContract;
use App\Http\Requests\Web\AssignmentWebRequest;
use App\Models\Assignment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;
use Illuminate\Http\Request;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;

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

        $result = $this->service->create($payload, ["attachment" => $attachment]);

        if ($result instanceof Exception) {
            return redirect()->back()->withErrors($result->getMessage());
        } else {
            return redirect()->route('assignment.index');
        }
    }

    public function destroy($id)
    {

        //check if have an id
        $assignment = Assignment::findOrFail($id);

        //SoftDeletes
        $assignment->delete();

        //return 
        return response()->json([
            'success' => true,
            'message' => 'Assignment has been deleted succesfuly'
        ]);
    }

    //restore deleted data
    public function restore($id)
    {
        //get deleted data with id
        $assignment_restore = Assignment::onlyTrashed()->findOrFail($id);
        //restoring data
        $assignment_restore->restore();

        return response()->json([
            'message' => 'Restore Data succesfuly',
            'data' => $assignment_restore
        ]);
    }

    //show deleted data
    public function trash(Request $request)
    {

        return view('assignment.trash');
        // $deleted_assignment = Assignment::onlyTrashed()->get();
        // return response()->json([
        //     'data' => $deleted_assignment
        // ]);
    }

    public function deleted(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = $request->get('perPage', 10);
        $search = $request->get("search");
        $where = $search ? [["number", "like", "%" . $search . "%"]] : [];

        // Mengambil data yang telah dihapus dengan onlyTrashed
        $deleted_assignment = Assignment::onlyTrashed()
            ->where($where)
            ->paginate($perPage, ['*'], 'page', $page);
        return response()->json($deleted_assignment);
    }

    //force delete data
    public function forceDelete($id)
    {
        $force_delete_assignment = Assignment::withTrashed()->findOrFail($id);
        $force_delete_assignment->forceDelete();

        return response()->json([
            'message' => 'Assignment has been permanently deleted successfully!'
        ]);
    }
}
