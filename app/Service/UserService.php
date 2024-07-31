<?php

namespace App\Service;

use App\Contract\UserContract;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService extends BaseService implements UserContract
{

    protected Model $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(array $params, $image = null, string|null $guard = null, string|null $foreignKey = null)
    {
        try {
            if (!is_null($guard) && !is_null($foreignKey)) {
                $authId = Auth::guard($guard)->id();
                $params = array_merge($params, [$foreignKey => $authId]);
            }

            DB::beginTransaction();

            if (!is_null($image)) {
                foreach ($image as $key => $value) {
                    unset($params[$key]);
                }
            }

            $model = $this->model->create($params);
            $model->assignRole('user');

            if (!is_null($image)) {
                foreach ($image as $key => $value) {
                    $model->addMultipleMediaFromRequest([$key])->each(function ($image) use ($key) {
                        $image->toMediaCollection($key);
                    });
                }
            }
            DB::commit();
            return $model->fresh();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }
}
