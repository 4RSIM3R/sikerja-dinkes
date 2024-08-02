<?php 

namespace App\Service;

use App\Contract\AppSettingContract;
use App\Models\AppSetting;
use Illuminate\Database\Eloquent\Model;

class AppSettingService extends BaseService implements AppSettingContract
{
    protected Model $model;

    public function __construct(AppSetting $model)
    {
        $this->model = $model;
    }
}