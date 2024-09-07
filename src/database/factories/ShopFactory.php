<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    protected $model = Shop::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'location' => $this->faker->city,
            'category' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
        ];
    }
}
