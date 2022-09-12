<?php

namespace Database\Seeders;

use App\Models\ShortLinks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShortLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShortLinks::factory()->count(20)->create();
    }
}
