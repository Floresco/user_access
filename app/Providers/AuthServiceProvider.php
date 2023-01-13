<?php

namespace App\Providers;

use App\Helpers\Utils;
use App\Models\AccessRight;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $access_rights = [];

        $this->registerPolicies();



        $access_rights = AccessRight::query()
            ->select(['wording'])
            ->get()->toArray();

        foreach ($access_rights as $access_right) {
            Gate::define($access_right['wording'], function (User $user, string $type) use ($access_right) {
                return Utils::RuleV2($access_right['wording'], $type);
            });
        }

        /*
        Gate::define('manage_dashboard', function (User $user, string $type) {
            return Utils::RuleV2('manage_dashboard',$type);
        });
        */
    }
}
