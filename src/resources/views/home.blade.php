@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h1 class="display-4 text-center">計算問題アプリ</h1>
    <div class="text-center mt-5">
        @foreach ($genres as $genre)
        <a class="btn btn-secondary btn-lg d-inline-block ml-2"
            href="{{ route('question', ['genre' => $genre->id]) }}">{{ $genre->title }}</a>
        @endforeach
    </div>
</div>
@endsection