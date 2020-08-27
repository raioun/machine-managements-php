@extends('layouts.admin')

@section('title', '新規機材名登録')
@section('content')

<div class="text-center">
  <h1>新規機材名登録</h1>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">

        <form action="{{ action('Admin\MachineController@create') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          
          <div class="form-group">
            <label>機材名</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label>型式1</label>
            <input class="form-control" type="text" name="type1" value="{{ old('type1') }}">
          </div>
          <div class="form-group">
            <label>型式2</label>
            <input class="form-control" type="text" name="type2" value="{{ old('type2') }}">
          </div>
          {{ csrf_field() }}
          <input type="submit" value="登録" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>

@endsection