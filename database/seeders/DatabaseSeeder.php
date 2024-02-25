<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Redirect;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\Requests::factory(10)->create();
        $this->call(RequestsSeeder::class);
        

    }
}
