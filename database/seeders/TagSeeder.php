<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = ['Laravel', 'PHP', 'JavaScript', 'VueJS', 'CSS'];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
