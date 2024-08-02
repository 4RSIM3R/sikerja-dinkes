<?php

namespace App\Service;

use App\Contract\WebSettingContract;
use App\Models\WebSetting;
use Illuminate\Database\Eloquent\Model;

class WebSettingService extends BaseService implements WebSettingContract
{
    protected Model $model;

    public function __construct(WebSetting $model)
    {
        $this->model = $model;
    }
}
