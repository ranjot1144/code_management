<?php

namespace Database\Factories;

use App\Models\Code;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Code>
 */
class CodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Code::class;

     public function definition()
     {
         return [
           'code' => $this->faker->unique()->numberBetween(100000, 999999),
           'allocated' => $this->faker->boolean(),
         ];
     }
}
