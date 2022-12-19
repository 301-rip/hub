<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KnownInstanceFactory extends Factory
{
    public function definition()
    {
        return [
            'domain' => $this->faker->domainName()
        ];
    }
}
