<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Redirect;

class RequestsSeeder extends Seeder
{
    public function run()
    {
        Redirect::create([
            'url_destino' => 'https://www.google.com.br',
            'ativo' => true,
        ]);

        // Seeders para o banco
    }
}
