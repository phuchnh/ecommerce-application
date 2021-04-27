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
            'cover_image' => '/static/placeholder.jpeg',
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'from_date' => now(),
            'to_date' => now()->addMonth()
        ];
    }
}
