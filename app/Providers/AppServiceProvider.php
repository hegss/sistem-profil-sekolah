<?php

namespace App\Providers;

use App\Models\Complaint;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        Paginator::useTailwind();

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Kirim data notifikasi komplain masuk ke seluruh tampilan admin
        View::composer('*', function ($view) {
            if (Schema::hasTable('complaints')) {
                $unreadComplaints = Complaint::where('status', 'accepted')
                    ->latest()
                    ->take(5)
                    ->get();

                $unreadComplaintsCount = Complaint::where('status', 'accepted')->count();

                $view->with([
                    'unreadComplaints' => $unreadComplaints,
                    'unreadComplaintsCount' => $unreadComplaintsCount,
                ]);
            }
        });
    }
}
