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


        // 足し算問題(genre_id=1)の作成
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
                'genre_id' => 1,
            ];
            $questions[] = $tmp;
        };
        DB::table('questions')->insert($questions);

        // 九九問題(genre_id=2)の作成
        $questions = [];
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 9; $j++) {
                $tmp = [
                    'content' => "$i x $j",
                    'answer' => $i * $j,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'genre_id' => 2,
                ];
                $questions[] = $tmp;
            }
        };
        DB::table('questions')->insert($questions);
    }
}
