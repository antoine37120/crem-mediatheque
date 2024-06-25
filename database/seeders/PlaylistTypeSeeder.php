<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaylistTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('playlist_types')->insert([
            'name' => 'Normal',
        ]);
        DB::table('playlist_types')->insert([
            'name' => 'Podcast',
        ]);
    }
}
