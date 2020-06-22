<?php

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->truncate();

        factory(App\User::class, 100)
            ->create()
            ->each(function ($user) {
                DB::table('activities')->insert([
                    'user_id' => $user->id,
                    'correct_answer_num' => mt_rand(0, 10),
                    'total_answer_num' => 10,
                    'correct_answer_second' => round(5 + mt_rand() / mt_getrandmax() * (30 - 5), 1),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'genre_id' => mt_rand(1, 2),
                ]);
            });
    }
}
