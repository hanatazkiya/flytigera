<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admins;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admins>
 */
class AdminsFactory extends Factory
{
    protected static ?string $password;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name(); return [
            'name' => $name,
            'username' => strtolower(explode(" ", $name)[0] . "_" . explode(" ", $name)[1]),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
