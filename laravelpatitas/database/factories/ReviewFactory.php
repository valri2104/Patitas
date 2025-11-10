<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $petReviewPhrases = [
            'My pet loves the texture and the flavor is perfect.',
            'We noticed improvements in energy after a week of use.',
            'The packaging keeps everything fresh and easy to serve.',
            'Excellent quality. Our vet recommended this product.',
            'Great for training sessions and rewards.',
            'The scent is gentle and my dog stays calm during baths.',
            'Very durable toy, survived weeks of playtime.',
            'Helps keep fur shiny and reduces shedding.',
            'Ideal size for small breeds, and no upset stomach.',
            'My cat refuses other brands after trying this one.',
        ];

        return [
            'user_id'       => User::inRandomOrder()->value('id')    ?? User::factory(),
            'product_id'    => Product::inRandomOrder()->value('id') ?? Product::factory(),
            'qualification' => $this->faker->biasedNumberBetween(3, 5, fn ($x) => $x ** 2),
            'description'   => $this->faker->randomElement($petReviewPhrases),
        ];
    }

    /**
     * Indicate a lower rating state for variety.
     */
    public function lowRating(): static
    {
        return $this->state(fn () => [
            'qualification' => $this->faker->numberBetween(1, 2),
            'description'   => $this->faker->sentence(12),
        ]);
    }
}
