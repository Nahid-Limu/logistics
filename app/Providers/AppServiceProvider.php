<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use DB;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

       Blade::directive('money', function ($amount) {
            return "<?php echo '৳' . number_format($amount, 2); ?>";
        });


        Blade::directive('dollarMoney', function ($amount) {
            return "<?php echo '$' . number_format($amount, 2); ?>";
        });

        $information=DB::table('tb_company_information')->first();
        view()->share('information',$information);

        $pending_order_notify_count=DB::table('tborder_details')->where('status',0)->count();
        view()->share('pending_order_notify_count',$pending_order_notify_count);


        $count_pending_order=DB::SELECT("SELECT count(tborder_details.vendorId) as order_count,tbvendor.name,tborder_details.vendorId as vendor_id,tborder_details.created_at
        FROM tborder_details
        LEFT join tbvendor ON tborder_details.vendorId=tbvendor.id
        WHERE tborder_details.status=0 GROUP BY tborder_details.vendorId ");

        view()->share('count_pending_order',$count_pending_order);


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
