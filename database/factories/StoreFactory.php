<?php

namespace Database\Factories;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory {
    protected $model = Store::class;

    public function definition(): array {
        return [
            'name' => $this->faker->company,
            'location' => $this->faker->address,
        ];
    }
}