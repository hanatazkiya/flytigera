<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // it's not a true factory, by the way
        return [
            "admin_id" => 1,
            "header_image" => "sample.jpg",
            "name" => "Lokawisata Baturaden",
            "short_description" => "Tempat sejuk yang menyenangkan Tempat sejuk yang menyenangkan Tempat sejuk yang menyenangkan Tempat sejuk yang menyenangkan Tempat sejuk yang menyenangkan",
            "description" => "Tempat sejuk yang menyenangkan",
            "price" => 18000,
            "slug" => "lokawisata-baturaden",
            "embedded_maps" => "youtube.com"
        ];
    }
}
