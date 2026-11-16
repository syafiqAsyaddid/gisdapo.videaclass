<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Gate::define('operator_sekolah', function (User $user) {
            return $user->hak_akses_id == 1;
        });

        Gate::define('sekolah', function (User $user) {
            return $user->hak_akses_id < 3;
        });

        Gate::define('kcd', function (User $user) {
            return $user->hak_akses_id == 3;
        });

        // Share Profil Lembaga to All Views (Cached)
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $profil_lembaga = \Illuminate\Support\Facades\Cache::remember('profil_lembaga_global', 3600, function () {
                try {
                    return \App\Models\ProfilLembaga::first();
                } catch (\Exception $e) {
                    return null;
                }
            });
            $view->with('profil_lembaga', $profil_lembaga);
        });
    }
}
