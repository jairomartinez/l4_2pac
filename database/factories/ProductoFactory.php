<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'codigo'=> fake()->unique()->numerify('###-#######'),
            'precio_compra'=> fake()->numberBetween(5, 500),
            'precio_venta' => fake()->numberBetween(10, 600),
            'nombre' => fake()->sentence(3),
            'proveedor_id'=>fake()->numberBetween(1, 50)
        ];
    }
}
