<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyect>
 */
class ProyectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'description' => $this->faker->address(),                        
            'leader_id' => $this->faker->numberBetween(1, 6),            
            'xml' => '<umldiagrams><UMLSequenceDiagram name="Diagrama de Secuencia" backgroundNodes="#ffffbb"/></umldiagrams>',            
        ];
    }
}
