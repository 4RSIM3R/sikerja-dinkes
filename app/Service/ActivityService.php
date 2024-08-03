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

    public function userActivity(int $userId, array $relations = [], array $whereConditions = [], bool $paginate = false, int|null $page = 1, int $dataPerPage = 10)
    {
        try {
            $query = $this->model::query()
                ->with($relations)
                ->orderBy('id', 'DESC');

            foreach ($whereConditions as $condition) {
                if (isset($condition[0], $condition[1], $condition[2])) {
                    if (strtolower($condition[1]) === 'like') {
                        $query->whereRaw('LOWER(' . $condition[0] . ') LIKE ?', [$condition[2]]);
                    } else {
                        $query->where($condition[0], $condition[1], $condition[2]);
                    }
                }
            }

            if (!empty($relationCount)) {
                foreach ($relationCount as $relation) {
                    $query->withCount($relation);
                }
            }

            $query->whereHas('attendances', fn ($query) => $query->where('id', $userId));

            if ($paginate) {
                $model = $query->latest()->paginate($dataPerPage, ["*"], "page", $page)->withQueryString();

                return [
                    'data' => $model,
                    'prev_page' => (int)mb_substr($model->previousPageUrl(), -1) ?: null,
                    'current_page' => $model->currentPage(),
                    'next_page' => (int)mb_substr($model->nextPageUrl(), -1) ?: null
                ];
            } else {
                return $query->get();
            }
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
