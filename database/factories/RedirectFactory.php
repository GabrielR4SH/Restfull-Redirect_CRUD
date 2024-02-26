<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Redirect;

class RedirectFactory extends Factory
{
    protected $model = Redirect::class;

    public function definition()
    {
        return [
            'url_destino' => $this->faker->url,
            'code' => $this->faker->unique()->slug,
            'ativo' => true,
            'last_access' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
