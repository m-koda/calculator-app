<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user(); // ログインしてなければnullが返る
        if ($user) {
            $temp_results = DB::table('activities')
                    ->select('activities.genre_id')
                    ->addselect('genres.title')
                    ->addselect(DB::raw('sum(activities.correct_answer_num) as correct_answer_num'))
                    ->addselect(DB::raw('sum(activities.total_answer_num) as total_answer_num'))
                    ->addselect(DB::raw('sum(activities.total_answer_num * activities.correct_answer_second) as total_correct_answer_second'))
                    ->where('user_id', $user->id)
                    ->leftJoin('genres', 'activities.genre_id', '=', 'genres.id')
                    ->groupBy('activities.genre_id')
                    ->orderBy('genres.id', 'asc')
                    ->get();
            $results = [];
            foreach ($temp_results as $temp_result) {
                $temp = [
                    'total_answer_num' => $temp_result->total_answer_num,
                    'total_correct_answer_num' => $temp_result->correct_answer_num,
                    'average_answer_second' => round($temp_result->total_correct_answer_second / $temp_result->total_answer_num, 1),
                    'correct_answer_rate' => round($temp_result->correct_answer_num / $temp_result->total_answer_num * 100, 1),
                    'genre' => $temp_result->title,
                ];
                $results[] = $temp;
            }
            return view('activity.index', ['results' => $results]);
        }
    }
}
