@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h1 class="display-4 text-center">計算問題アプリ</h1>
    <div class="text-center mt-5"><a class="btn btn-outline-dark btn-lg" href="{{ route('question') }}"
            role="button">Start</a></div>
</div>
@endsection