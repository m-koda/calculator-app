<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::inRandomOrder()->take(5)->get();
        return view('question.index', ['questions' => $questions]);
    }
}
