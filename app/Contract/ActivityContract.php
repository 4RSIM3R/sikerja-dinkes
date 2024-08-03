<?php

namespace App\Contract;

interface ActivityContract extends BaseContract
{
    public function userActivity(int $userId, array $whereConditions = [], bool $paginate = false, int|null $page = 1, int $dataPerPage = 10);
}
