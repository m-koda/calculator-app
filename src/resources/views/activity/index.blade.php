@extends('layouts.app')

@section('content')
<div class="jumbotron">
  <ul class="list-group" style="width: 30%; margin: 0 auto;">
    @foreach ($results as $result)
    <li class="list-group-item list-group-item-dark">{{ $result['genre'] }}</li>
    <li class="list-group-item">正解率: {{ $result['correct_answer_rate'] }}% ({{ $result['total_correct_answer_num'] }}
      / {{ $result['total_answer_num'] }})</li>
    <li class="list-group-item">平均解答時間: {{ $result['average_answer_second'] }}秒</li>
    @endforeach
  </ul>
</div>
@endsection