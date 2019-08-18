<?php

namespace App\Providers;

use App\Conversation;
use App\Policies\ConversationPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Conversation::class => ConversationPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();
        Passport::routes();

        // Grant "Super Admin" users all permissions (assuming they are verified using can() and other gate-related functions):
        $gate->before(function ($user, $ability) {
            if ($user->is_supporter) {
                return true;
            }
        });

        //
    }
}
