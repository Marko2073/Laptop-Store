<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        $BezOvih=[
            'migrations',
            'password_resets',
            'failed_jobs',
            'password_reset_tokens',
            'personal_access_tokens',
            'user_cart',
            'purchases',
            'credit_cards',


        ];
        $tables = DB::select('SHOW TABLES');
        $tabele = [];
        foreach ($tables as $table) {
            $k = reset($table);
            if (!in_array($k, $BezOvih)) {
                array_push($tabele, $k);
            }


        }

        view()->share('tabele', $tabele);

        $menu = Menu::all();
        view()->share('menu', $menu);
       Paginator::useBootstrapFour();
    }
}
