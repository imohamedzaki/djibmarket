<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\SellerDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SellerDocument>
 */
class SellerDocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SellerDocument::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ensure SellerSeeder has run or fetch/create a default one
        // Note: This assumes the SellerFactory might be called before this factory
        // in a seeder context, ensuring sellers exist.
        $seller = Seller::inRandomOrder()->first();
        if (!$seller) {
            // Create a seller if none exist, rely on SellerFactory defaults
            $seller = Seller::factory()->create();
        }

        $docTypes = ['Trade License', 'VAT Certificate', 'ID Card', 'Passport'];

        return [
            'seller_id' => $seller->id,
            'document_type' => fake()->randomElement($docTypes),
            'document_path' => 'storage/sellers/fake/' . fake()->uuid . '.pdf', // Fixed path with sellers/ prefix
            'expiry_date' => fake()->dateTimeBetween('+1 month', '+2 years'), // Always generate an expiry date
        ];
    }
}
