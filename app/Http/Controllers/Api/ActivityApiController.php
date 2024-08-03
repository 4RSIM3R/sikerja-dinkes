<?php

namespace App\Http\Controllers\Api;

use App\Contract\ActivityContract;
use App\Http\Controllers\Controller;
use App\Utils\WebResponseUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityApiController extends Controller
{
    protected ActivityContract $attendance;

    public function __construct(ActivityContract $attendance)
    {
        $this->attendance = $attendance;
    }

    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $user = Auth::guard('api')->user();

        $result = $this->attendance->userActivity($user->id, paginate: true, page: $page, relations: ['attendances']);
        return WebResponseUtils::response($result);
    }

    public function show(int $id)
    {
    }

    public function attendance(int $id)
    {
    }

    public function reimbursement(int $id)
    {
    }
}
