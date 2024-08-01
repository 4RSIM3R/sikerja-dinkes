<?php

namespace App\Service;

use App\Contract\ActivityContract;
use App\Models\Activity;
use App\Models\Attendance;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ActivityService extends BaseService implements ActivityContract
{

    protected Model $model;

    public function __construct(Activity $model)
    {
        $this->model = $model;
    }

    public function create(array $params, $image = null, string|null $guard = null, string|null $foreignKey = null)
    {
        try {

            DB::beginTransaction();

            $users = $params['user_id'];
            unset($params['user_id']);

            $model = $this->model->create($params);

            $activities = [];

            foreach ($users as $user) {
                $activities[] = [
                    'activity_id' => $model->id,
                    'user_id' => $user,
                    'status' => 'waiting',
                ];
            }

            Attendance::insert($activities);

            DB::commit();
            return $model->fresh();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }
}
