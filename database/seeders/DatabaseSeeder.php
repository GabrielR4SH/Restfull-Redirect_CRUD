<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Redirect;
use App\Models\RedirectLog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Redirect::factory(10)->create();
        RedirectLog::factory(10)->create();
    }
}
