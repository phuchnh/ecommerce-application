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
            'img_cover' => $this->faker->imageUrl(),
            'title' => $this->faker->title,
            'content' => $this->faker->randomHtml(),
            'from_date' => $this->faker->dateTime,
            'to_date' => $this->faker->dateTime,
            'published_at' => $this->faker->dateTime,
        ];
    }
}
