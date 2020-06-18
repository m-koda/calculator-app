@extends('layouts.app')

@section('content')
<div class="jumbotron">
  <div class="card" style="width: 18rem; margin: 0 auto;">
    <div class="card-header text-center">成績</div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">正解率: {{ $result['correct_answer_rate'] }}% ({{ $result['total_correct_answer_num'] }}
        / {{ $result['total_answer_num'] }})</li>
      <li class="list-group-item">平均解答時間: {{ $result['average_answer_second'] }}秒</li>
    </ul>
  </div>
</div>
@endsection