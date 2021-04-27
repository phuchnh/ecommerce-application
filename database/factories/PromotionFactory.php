<?php

namespace Database\Factories;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promotion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'promotion_type' => $this->faker->randomElement(['offline', 'online']),
            'img_cover' => '/static/6f6e2ef709fef97a.jpg',
            'title' => $this->faker->sentence,
            'content' => $this->faker->randomHtml(),
            'from_date' => now(),
            'to_date' => now()->addMonth(),
            'published_at' => $this->faker->dateTime,
        ];
    }
}
