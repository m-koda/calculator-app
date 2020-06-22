<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $genre_id = $request->query('genre');
        $questions = Question::where('genre_id', $genre_id)->inRandomOrder()->take(5)->get();
        return view('question.index', ['questions' => $questions, 'genre_id' => $genre_id]);
    }
}
