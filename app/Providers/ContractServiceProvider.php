<?php

namespace App\Providers;

use App\Contract\ActivityContract;
use App\Contract\AppSettingContract;
use App\Contract\AssignmentContract;
use App\Contract\AttendanceContract;
use App\Contract\BaseContract;
use App\Contract\ReimburseContract;
use App\Contract\UserContract;
use App\Contract\WebSettingContract;
use App\Service\ActivityService;
use App\Service\AppSettingService;
use App\Service\AssignmentService;
use App\Service\AttendanceService;
use App\Service\BaseService;
use App\Service\ReimburseService;
use App\Service\UserService;
use App\Service\WebSettingService;
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
        $this->app->bind(WebSettingContract::class, WebSettingService::class);
        $this->app->bind(AppSettingContract::class, AppSettingService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
