<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadMigrationsFrom([
            base_path("database" . $ds . "migrations" . $ds . "admin"),
            base_path("database" . $ds . "migrations" . $ds . "events"),
            base_path("database" . $ds . "migrations" . $ds . "form"),
            base_path("database" . $ds . "migrations" . $ds . "members"),
            base_path("database" . $ds . "migrations" . $ds . "memberships"),
            base_path("database" . $ds . "migrations" . $ds . "speakers"),
            base_path("database" . $ds . "migrations" . $ds . "system"),
            base_path("database" . $ds . "migrations" . $ds . "users"),
        ]);
    }
}
