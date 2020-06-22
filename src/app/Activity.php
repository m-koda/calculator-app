<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'user_id',
        'correct_answer_num',
        'total_answer_num',
        'correct_answer_second',
        'genre_id',
    ];
}
