<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();


        $questions = [];
        for ($i = 0; $i < 100; $i++) {
            $a = mt_rand(0, 100);
            $b = mt_rand(0, 100);
            $answer = $a + $b;
            $tmp = [
                'content' => "$a + $b",
                'answer' => $answer,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $questions[] = $tmp;
        };
        DB::table('questions')->insert($questions);
    }
}
