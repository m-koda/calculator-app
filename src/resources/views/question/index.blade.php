@extends('layouts.app')

@section('content')
<div class="jumbotron">
  <h1 class="display-5 text-center">第1問</h1>
  <h3 class="text-center mt-4">1 + 1 = ?</h3>
  <form class="mt-4">
    <div class="form-row">
      <div class="col-4"></div>
      <div class="col-4">
        <div class="form-group">
          <input type="text" class="form-control" id="formGroupExampleInput" placeholder="解答を入力">
        </div>
      </div>
      <div class="col-4"></div>
    </div>
    <div class="text-center mt-3">
      <button type="submit" class="btn btn-outline-dark">解答する</button>
    </div>
  </form>
</div>
@endsection