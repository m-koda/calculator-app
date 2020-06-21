<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Mail;
use App\Mail\ActivityMail;

class SendActivityMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:activity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Send email which contains yesterday's activity";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 前日の成績を取得する
        $today = today();
        $yesterday = $today->subDay();
        $start_of_yesterday = $yesterday->toDateTimeString();
        $end_of_yesterday = $yesterday->addSeconds(86399)->toDateTimeString();
        $all_users = User::with('activities')->get();
        $all_data = [];
        foreach ($all_users as $user) {
            $activities_of_yesterday = $user->activities()
                            ->whereBetween('created_at', [$start_of_yesterday, $end_of_yesterday])
                            ->get();
            if (count($activities_of_yesterday)) {
                $correct_answer_num = 0;
                $total_answer_num = 0;
                $correct_answer_second = 0;
                foreach ($activities_of_yesterday as $activity) {
                    $correct_answer_num += $activity->correct_answer_num;
                    $total_answer_num += $activity->total_answer_num;
                    $correct_answer_second += $activity->correct_answer_second * $activity->total_answer_num;
                }
                $data = [
                    'user_name' => $user->name,
                    'email' => $user->email,
                    'correct_answer_num' => $correct_answer_num,
                    'total_answer_num' => $total_answer_num,
                    'correct_answer_second' => round($correct_answer_second / $total_answer_num, 1),
                    'correct_answer_rate' => round($correct_answer_num / $total_answer_num * 100, 1),
                ];
            } else {
                //前日の成績がない場合
                $data = [
                    'user_name' => $user->name,
                    'email' => $user->email,
                    'correct_answer_num' => 0,
                    'total_answer_num' => 0,
                    'correct_answer_second' => 0,
                    'correct_answer_rate' => 0,
                ];
            }
            $all_data[] = $data;
        }
        // 取得した成績をメール送信する
        $date = $yesterday->format('m/d');
        foreach ($all_data as $data) {
            Mail::to($data['email'])->send(new ActivityMail($data, $date));
        }
    }
}
