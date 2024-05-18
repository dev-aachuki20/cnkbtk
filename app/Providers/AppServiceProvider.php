<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\Section;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;

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
    {   // Custom Date Directive
        Blade::directive('formattedDate', function ($expression) {
            return "<?php echo Carbon\Carbon::parse($expression)->format(config('app.date_format')); ?>";
        });

        // Custom DateTime Directive
        Blade::directive('formattedDateTime', function ($expression) {
            return "<?php echo Carbon\Carbon::parse($expression)->format(config('app.datetime_format')); ?>";
        });

        // Getting menues to show in header
        if (Schema::hasTable('sections')) {
            $sections = Section::where(function ($query) {
                $query->orWhere("show_in_header", 1)->orWhere("show_in_footer", 1);
            })->where("status", 1)->get();
            View::share('menues', $sections);
        }
        Paginator::useBootstrapFive();
    }
}
