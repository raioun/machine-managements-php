@extends('layouts.admin')

@section('title', 'ユーザ編集')
@section('content')

<div class="text-center">
  <h1>ユーザ編集</h1>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        
        <form action="{{ action('Admin\UserController@update') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
    
          <div class="form-group">
            <label for="user_name">ユーザ名</label>
            <input class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}"/>
          </div>
          
          <div class="form-group">
            <label for="user_password">パスワード</label>
            <input class="form-control" type="password" name="password" value="{{ $user->password }}"/>
          </div>

          <div class="form-group">
            <label for="user_status">状態</label>
            <select class="form-control" name="status">
              <option @if(old('status', $user->status) == 0)selected="selected" @endif value="0">在籍中</option>
              <option @if(old('status', $user->status) == 1)selected="selected" @endif value="1">退社済み</option>
            </select>
          </div>
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $user->id }}">
          <input type="submit" value="Signup" class="btn btn-success" data-disable-with="Signup" />
        </form>
      </div>
    </div>
  </div>

@endsection