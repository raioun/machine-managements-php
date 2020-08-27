@extends('layouts.admin')

@section('title', '顧客企業編集')
@section('content')

<div class="text-center">
  <h1>顧客企業編集</h1>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        
        <form action="{{ action('Admin\CustomerController@update') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          
          <div class="form-group">
            <label>顧客企業名</label>
            <input class="form-control" type="text" name="name" value="{{ old('name', $customer->name) }}">
          </div>
          <div class="form-group row">
            <div class="col-md-10">
              <input type="hidden" name="id" value="{{ $customer->id }}">
              {{ csrf_field() }}
              <input type="submit" value="登録" class="btn btn-primary">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  
@endsection