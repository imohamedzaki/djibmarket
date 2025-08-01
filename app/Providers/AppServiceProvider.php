<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Removed observer imports as they are no longer needed here
use App\Models\BusinessActivity;
use App\Observers\BusinessActivityObserver;
use App\Models\Category;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\View;
use App\Models\EmailLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


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
        if (DB::getDriverName() === 'mysql') {
            DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        }

        // Observer registration moved to EventServiceProvider
        BusinessActivity::observe(BusinessActivityObserver::class);
        Category::observe(CategoryObserver::class);

        View::composer('layouts.app.partials.buyer.mega_menu', function ($view) {
            $megaMenuCategories = Category::whereNull('parent_id')
                ->with([
                    'children.children', // Eager load children and grandchildren
                    'topBrands', // Load top brands for each category
                    'ads' => function ($query) {
                        $query->where('active', true)
                            ->where('starts_at', '<=', now())
                            ->where('ends_at', '>=', now())
                            ->orderBy('position');
                    }
                ])
                ->get();
            $view->with('megaMenuCategories', $megaMenuCategories);
        });

        // View composer for admin notifications
        View::composer('layouts.app.includes.admin.dropdownNotification', function ($view) {
            // Get failed emails from today and yesterday for notifications
            $failedEmails = EmailLog::where('status', 'failed')
                ->where('queued_at', '>=', Carbon::now()->subDay())
                ->orderBy('queued_at', 'desc')
                ->limit(10)
                ->get();

            // Get count of unread notifications (we'll mark them as read when admin visits email dashboard)
            $unreadCount = $failedEmails->count();

            $view->with([
                'emailNotifications' => $failedEmails,
                'unreadNotificationsCount' => $unreadCount
            ]);
        });
    }
}