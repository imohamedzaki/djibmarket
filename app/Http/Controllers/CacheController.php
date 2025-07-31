<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CacheController extends Controller
{
    public function clearCache()
    {
        $previousUrl = url()->previous() ?: '/';

        try {
            // Clear all Laravel caches
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            \Illuminate\Support\Facades\Artisan::call('route:clear');
            \Illuminate\Support\Facades\Artisan::call('view:clear');
            \Illuminate\Support\Facades\Artisan::call('event:clear');
            \Illuminate\Support\Facades\Artisan::call('queue:clear');
            \Illuminate\Support\Facades\Artisan::call('config:cache');

            try {
                \Illuminate\Support\Facades\Artisan::call('clear-compiled');
            } catch (\Exception $e) {
                // Ignore if command doesn't exist
            }

            return redirect($previousUrl)->with('success', 'Emergency cache clear completed!');
        } catch (\Exception $e) {
            return redirect($previousUrl)->with('error', 'Error clearing caches: ' . $e->getMessage());
        }
    }

    public function emergencyClearCache()
    {
        $previousUrl = url()->previous() ?: '/';

        try {
            // Clear all Laravel caches
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            \Illuminate\Support\Facades\Artisan::call('route:clear');
            \Illuminate\Support\Facades\Artisan::call('view:clear');
            \Illuminate\Support\Facades\Artisan::call('event:clear');
            \Illuminate\Support\Facades\Artisan::call('queue:clear');
            \Illuminate\Support\Facades\Artisan::call('config:cache');

            try {
                \Illuminate\Support\Facades\Artisan::call('clear-compiled');
            } catch (\Exception $e) {
                // Ignore if command doesn't exist
            }

            return redirect($previousUrl)->with('success', 'Emergency cache clear completed!');
        } catch (\Exception $e) {
            return redirect($previousUrl)->with('error', 'Error clearing caches: ' . $e->getMessage());
        }
    }
}