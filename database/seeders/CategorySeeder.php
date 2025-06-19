<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    \App\Models\Category::create(['name' => 'تقنية']);
    \App\Models\Category::create(['name' => 'رياضة']);
}
}
