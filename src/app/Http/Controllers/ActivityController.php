<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user(); // ログインしてなければnullが返る
        if ($user) {
            $activities = $user->activities;
            $total_answer_num = 0;
            $total_correct_answer_num = 0;
            $total_correct_answer_second = 0;
            foreach ($activities as $activity) {
                $total_answer_num += $activity->total_answer_num;
                $total_correct_answer_num += $activity->correct_answer_num;
                $total_correct_answer_second += $activity->correct_answer_second * $activity->total_answer_num;
            };
            $result = [
                'total_answer_num' => $total_answer_num,
                'total_correct_answer_num' => $total_correct_answer_num,
                'average_answer_second' => round($total_correct_answer_second / $total_answer_num, 1),
                'correct_answer_rate' => round($total_correct_answer_num / $total_answer_num * 100, 1),
            ];
            return view('activity.index', ['result' => $result]);
        }
    }
}
