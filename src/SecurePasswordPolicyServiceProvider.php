<?php

namespace LoopLinguist\SecurePasswordPolicy;

use Illuminate\Support\ServiceProvider;

class SecurePasswordPolicyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(
            __DIR__ . '/config/secure-password-policy.php',
            'secure-password-policy'
        );
        $this->publishes([
            __DIR__ . '/config/secure-password-policy.php' => config_path('secure-password-policy.php')
        ], 'secure-password-policy-config');

        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations')
        ], 'secure-password-policy-migrations');
    }

    public function register()
    {
    }
}
