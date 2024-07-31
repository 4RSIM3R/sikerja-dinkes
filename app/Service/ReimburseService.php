<?php

namespace App\Service;

use App\Contract\ReimburseContract;
use App\Models\Reimbursement;
use Illuminate\Database\Eloquent\Model;

class ReimburseService extends BaseService implements ReimburseContract
{

    protected Model $model;

    public function __construct(Reimbursement $model)
    {
        $this->model = $model;
    }


}
