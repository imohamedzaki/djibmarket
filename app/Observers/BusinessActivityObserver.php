<?php

namespace App\Observers;

use App\Models\BusinessActivity;
use Illuminate\Support\Str; // Import Str facade

class BusinessActivityObserver
{
    /**
     * Handle the BusinessActivity "creating" event.
     */
    public function creating(BusinessActivity $businessActivity): void
    {
        $baseSlug = Str::slug($businessActivity->name);
        $slug = $baseSlug; // Start with the basic slug

        // Check if the base slug already exists in the database
        if (BusinessActivity::where('slug', $slug)->exists()) {
            // --- This block only runs if the base slug is NOT unique ---
            $counter = 0;
            do {
                // Generate a potential slug with a random number
                $randomNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $potentialSlug = $baseSlug . '-' . $randomNumber;
                // Check if this numbered slug exists
                $exists = BusinessActivity::where('slug', $potentialSlug)->exists();
                $counter++;
                // Loop until we find a unique numbered slug or exceed attempts
            } while ($exists && $counter < 10);

            // If we still haven't found a unique slug after 10 tries, use a timestamp
            if ($exists) {
                $slug = $baseSlug . '-' . time();
                // You might want to add a final check here just in case of a timestamp collision (extremely rare)
                // if (BusinessActivity::where('slug', $slug)->exists()) { /* Handle error */ }
            } else {
                // Use the unique numbered slug we found
                $slug = $potentialSlug;
            }
            // --- End of block for non-unique base slugs ---
        }
        // If the initial check found the base slug was unique, the 'if' block was skipped,
        // and $slug still holds the original $baseSlug.

        // Assign the final unique slug (either the original base or the numbered/timestamped one)
        $businessActivity->slug = $slug;
    }

    /**
     * Handle the BusinessActivity "created" event.
     */
    public function created(BusinessActivity $businessActivity): void
    {
        //
    }

    /**
     * Handle the BusinessActivity "updating" event.
     *
     * This runs when an existing model is being updated.
     */
    public function updating(BusinessActivity $businessActivity): void
    {
        // Check if the name field has actually been changed
        if ($businessActivity->isDirty('name')) {
            $baseSlug = Str::slug($businessActivity->name); // Generate slug from the new name
            $slug = $baseSlug;

            // Check if the generated slug exists for *another* record
            if (BusinessActivity::where('slug', $slug)->where('id', '!=', $businessActivity->id)->exists()) {
                // --- Slug is not unique (excluding the current model), generate a unique one ---
                $counter = 0;
                do {
                    $randomNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                    $potentialSlug = $baseSlug . '-' . $randomNumber;
                    // Check if this numbered slug exists for another record
                    $exists = BusinessActivity::where('slug', $potentialSlug)->where('id', '!=', $businessActivity->id)->exists();
                    $counter++;
                } while ($exists && $counter < 10);

                if ($exists) {
                    $slug = $baseSlug . '-' . time();
                    // Final check for timestamp collision (rare)
                    // if (BusinessActivity::where('slug', $slug)->where('id', '!=', $businessActivity->id)->exists()) { /* Handle */ }
                } else {
                    $slug = $potentialSlug;
                }
                // --- End of uniqueness generation ---
            }
            // If the base slug was unique (or the original name wasn't changed), $slug remains the base slug.

            // Assign the potentially updated slug
            $businessActivity->slug = $slug;
        }
    }

    /**
     * Handle the BusinessActivity "updated" event.
     */
    public function updated(BusinessActivity $businessActivity): void
    {
        //
    }

    /**
     * Handle the BusinessActivity "deleted" event.
     */
    public function deleted(BusinessActivity $businessActivity): void
    {
        //
    }

    /**
     * Handle the BusinessActivity "restored" event.
     */
    public function restored(BusinessActivity $businessActivity): void
    {
        //
    }

    /**
     * Handle the BusinessActivity "force deleted" event.
     */
    public function forceDeleted(BusinessActivity $businessActivity): void
    {
        //
    }
}