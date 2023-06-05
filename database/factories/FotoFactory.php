<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Foto>
 */
class FotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new \Mmo\Faker\PicsumProvider($this->faker));
        return [
            'titulo'=>ucfirst($this->faker->unique()->words(random_int(2,4),true)),
            'descripcion'=>$this->faker->text(),
            'category_id'=>Category::all()->random()->id,
            'user_id'=>User::all()->random()->id,
            'publicada'=>random_int(1,2),
            'imagen'=>'imagenes/'.$this->faker->picsum(dir: "public/storage/imagenes/", height: 480, width: 640, fullPath: false),
        ];
    }
}
