@extends('layouts.admin')

@section('title', '新規ユーザ登録')
@section('content')
      
<div class="text-center">
  <h1>ユーザ登録</h1>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">

        <form action="{{ action('Admin\UserController@create') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          
          <div class="form-group">
            <label for="user_name">ユーザ名</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}"/>
          </div>
          
          <div class="form-group">
            <label for="user_password">パスワード</label>
            <input class="form-control" type="password" name="password" />
          </div>

          {{ csrf_field() }}
          <input type="submit" value="Signup" class="btn btn-success" data-disable-with="Signup" />
        </form>
      </div>
    </div>
  </div>

@endsection