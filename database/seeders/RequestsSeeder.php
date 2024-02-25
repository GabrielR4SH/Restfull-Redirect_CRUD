<?php 

use Illuminate\Database\Seeder;
use App\Models\Requests;

class RequestsSeeder extends Seeder
{
    public function run()
    {
        Requests::create([
            'url_destino' => 'https://www.google.com.br',
            'ativo' => true,
        ]);

        Requests::create([
            'url_destino' => 'https://www.example.com',
            'ativo' => false,
        ]);

        // Seeders para o banco
    }
}
