@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h1 class="display-4 text-center">計算問題アプリ</h1>
    <form method="GET" action="{{ route('question') }}" class="mt-4">
        <div class="form-row">
            <div class="col-3"></div>
            <div class="col-6 text-center">
                <h3 class="border-bottom">問題数</h3>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="questionsNum" id="inlineRadio1" value="10"
                        checked>
                    <label class="form-check-label" for="inlineRadio1">10問</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="questionsNum" id="inlineRadio2" value="20">
                    <label class="form-check-label" for="inlineRadio2">20問</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="questionsNum" id="inlineRadio3" value="30">
                    <label class="form-check-label" for="inlineRadio3">30問</label>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="form-row mt-4">
            <div class="col-3"></div>
            <div class="col-6 text-center">
                <h3 class="border-bottom">ジャンル</h3>
                @foreach ($genres as $genre)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="genre" id="genre_{{ $genre->id }}"
                        value="{{ $genre->id }}" @if ($loop->first) checked @endif>
                    <label class="form-check-label" for=genre_{{ $genre->id }}">{{ $genre->title }}</label>
                </div>
                @endforeach
            </div>
            <div class="col-3"></div>
        </div>
        <div class="form-row mt-4">
            <div class="col-3"></div>
            <div class="col-6 text-center">
                <button type="submit" class="btn btn-secondary">Start</button>
            </div>
            <div class="col-3"></div>
        </div>
    </form>
</div>
@endsection