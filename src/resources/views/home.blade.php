@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h1 class="display-4 text-center">計算問題アプリ</h1>
    <div class="text-center mt-5">
        <a class="btn btn-outline-dark btn-lg d-inline-block" href="{{ route('question', ['genre' => 1]) }}">足し算</a>
        <a class="btn btn-outline-dark btn-lg d-inline-block ml-2" href="{{ route('question', ['genre' => 2]) }}">九九</a>
    </div>
</div>
@endsection