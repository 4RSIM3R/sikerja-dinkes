<?php

namespace App\Http\Controllers\Api;

use App\Contract\ActivityContract;
use App\Contract\AttendanceContract;
use App\Contract\ReimburseContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AttendanceApiRequest;
use App\Http\Requests\Api\ReimburseApiRequest;
use App\Models\Attendance;
use App\Utils\WebResponseUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityApiController extends Controller
{
    protected ActivityContract $activity;
    protected ReimburseContract $reimbursement;
    protected AttendanceContract $attendance;

    public function __construct(ActivityContract $activity, ReimburseContract $reimbursement, AttendanceContract $attendance)
    {
        $this->activity = $activity;
        $this->reimbursement = $reimbursement;
        $this->attendance = $attendance;
    }

    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $user = Auth::guard('api')->user();

        $result = $this->activity->userActivity($user->id, paginate: true, page: $page);
        return WebResponseUtils::response($result);
    }

    public function show(int $id)
    {
        $result = $this->activity->findById($id);
        return WebResponseUtils::response($result);
    }

    public function attendance(int $id, AttendanceApiRequest $request)
    {
        $payload = $request->validated();
        $image = $request->file('image');
        $user_id = Auth::guard('api')->user()->id;

        $payload['activity_id'] = $id;
        $payload['user_id'] = $user_id;
        $payload['status'] = 'present';

        unset($payload['image']);

        $attendance_id = Attendance::query()->where('activity_id', $id)->where('user_id', $user_id)->first()->id;

        $result = $this->attendance->update($attendance_id, $payload, ["image" => $image]);

        return WebResponseUtils::response($result);
    }

    public function reimbursement(int $id, ReimburseApiRequest $request)
    {
        $payload = $request->validated();
        $user_id = Auth::guard('api')->user()->id;

        $payload['activity_id'] = $id;
        $payload['user_id'] = $user_id;

        $result = $this->reimbursement->create($payload);

        return WebResponseUtils::response($result);
    }
}
