<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $users    = User::all();

        if ($products->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Skipping ReviewSeeder because there are no products or users.');

            return;
        }

        $totalReviews   = fake()->numberBetween(50, 80);
        $highRatingBias = (int) round($totalReviews * 0.75);

        // Create a majority of positive reviews
        Review::factory()
            ->count($highRatingBias)
            ->state(fn () => $this->randomUserProductState($users, $products))
            ->create();

        // Create the remaining reviews with lower ratings
        Review::factory()
            ->lowRating()
            ->count($totalReviews - $highRatingBias)
            ->state(fn () => $this->randomUserProductState($users, $products))
            ->create();
    }

    private function randomUserProductState(Collection $users, Collection $products): array
    {
        return [
            'user_id'    => $users->random()->getId(),
            'product_id' => $products->random()->getId(),
        ];
    }
}
