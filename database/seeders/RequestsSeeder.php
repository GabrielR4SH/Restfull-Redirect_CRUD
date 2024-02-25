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
    }
}
