<?php

namespace Database\Factories;

use App\Models\BusinessActivity;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seller::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ensure BusinessActivitySeeder has run or fetch/create a default one
        $businessActivity = BusinessActivity::inRandomOrder()->first();
        if (!$businessActivity) {
            $businessActivity = BusinessActivity::factory()->create(['name' => 'Default Activity']);
        }

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // default password
            'remember_token' => Str::random(10),
            'business_activity_id' => $businessActivity->id,
            'status' => 'active',
        ];
    }
}