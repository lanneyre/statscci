<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Centre::factory(9)->create();
    }
}
