<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            [
                'title' => '足し算',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '九九',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
