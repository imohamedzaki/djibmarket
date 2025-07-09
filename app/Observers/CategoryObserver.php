<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "creating" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function creating(Category $category): void
    {
        if (empty($category->slug)) {
            $category->slug = Str::slug($category->name);

            // Ensure slug uniqueness (optional but recommended)
            $originalSlug = $category->slug;
            $count = 1;
            // Check against existing slugs, excluding the current model if it somehow has an ID already
            while (Category::where('slug', $category->slug)->when($category->id, fn($query, $id) => $query->where('id', '!=', $id))->exists()) {
                $category->slug = "{$originalSlug}-{$count}";
                $count++;
            }
        }
    }

    /**
     * Handle the Category "updating" event.
     *
     * Optionally, you might want to update the slug if the name changes.
     * Be careful with this, as changing slugs can affect SEO and bookmarks.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    /* // Uncomment if you want to update slug on name change
    public function updating(Category $category): void
    {
        // Check if the name is being changed and slug is not manually set
        if ($category->isDirty('name') && !$category->isDirty('slug')) {
             $category->slug = Str::slug($category->name);
             // Add uniqueness check here as well
             $originalSlug = $category->slug;
             $count = 1;
             while (Category::where('slug', $category->slug)->where('id', '!=', $category->id)->exists()) {
                 $category->slug = "{$originalSlug}-{$count}";
                 $count++;
             }
        }
    }
    */

    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
