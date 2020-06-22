<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class HomeController extends Controller
{
    public function index()
    {
        $genres = Genre::orderBy('id', 'asc')->get();
        return view('home', ['genres' => $genres]);
    }
}
