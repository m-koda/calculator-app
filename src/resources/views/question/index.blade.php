@extends('layouts.app')

@section('content')
<question-component v-bind:base-questions='@json($questions)'></question-component>
@endsection