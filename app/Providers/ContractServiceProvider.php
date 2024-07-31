<?php

namespace App\Providers;

use App\Contract\ActivityContract;
use App\Contract\AssignmentContract;
use App\Contract\AttendanceContract;
use App\Contract\BaseContract;
use App\Contract\ReimburseContract;
use App\Contract\UserContract;
use App\Service\ActivityService;
use App\Service\AssignmentService;
use App\Service\AttendanceService;
use App\Service\BaseService;
use App\Service\ReimburseService;
use App\Service\UserService;
use Illuminate\Support\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BaseContract::class, BaseService::class);

        $this->app->bind(ActivityContract::class, ActivityService::class);
        $this->app->bind(AssignmentContract::class, AssignmentService::class);
        $this->app->bind(AttendanceContract::class, AttendanceService::class);
        $this->app->bind(ReimburseContract::class, ReimburseService::class);
        $this->app->bind(UserContract::class, UserService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
