<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fileTypes = ['pdf', 'doc', 'jpg', 'png', 'xlsx'];
        $fileType = fake()->randomElement($fileTypes);

        return [
            'name' => fake()->word().'.'.$fileType,
            'path' => 'files/'.fake()->uuid().'.'.$fileType,
        ];
    }
}
