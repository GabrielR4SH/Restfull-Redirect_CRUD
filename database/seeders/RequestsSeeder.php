<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Redirect;
use Vinkla\Hashids\Facades\Hashids;

class RequestsSeeder extends Seeder
{
    public function run()
    {
        Redirect::create([
            'url_destino' => 'https://www.google.com.br',
            'code' => Hashids::encode(1), // Gerando um código para o primeiro registro
            'ativo' => true,
        ]);

        Redirect::create([
            'url_destino' => 'https://www.example.com',
            'code' => Hashids::encode(2),
            'ativo' => true,
        ]);

        Redirect::create([
            'url_destino' => 'https://www.yahoo.com',
            'code' => Hashids::encode(3),
            'ativo' => false,
        ]);

        Redirect::create([
            'url_destino' => 'https://www.microsoft.com',
            'code' => Hashids::encode(4),
            'ativo' => false,
        ]);
    }

}
