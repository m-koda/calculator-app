@extends('layouts.app')

@section('content')
<question-component v-bind:base-questions='@json($questions)' v-bind:base-genre-id='{{$genre_id}}'>
</question-component>
@endsection