@extends('layouts.admin')

@section('title', '新規現場登録')
@section('content')

<div class="text-center">
  <h1>新規現場登録</h1>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        
        <form action="{{ action('Admin\ProjectController@create') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          
            <div class="form-group">
              <label for="project_customer_id">顧客企業名</label>
              <select class="mySelect2" name="customer_id">
                @foreach($customers as $customer)
                  <option @if(old('customer_id') == $customer->id) selected="selected" @endif value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
              </select>
            </div>
        
            <div class="form-group">
              <label for="project_name">現場名</label>
              <input class="form-control" type="text" name="name" value="{{ old('name') }}"/>
            </div>
    
            <div class="form-group">
              <label for="project_address">住所</label>
              <input class="form-control" type="text" name="address" value="{{ old('address') }}"/>
            </div>
            {{ csrf_field() }}
          <input type="submit" value="登録" class="btn btn-success" data-disable-with="登録" />
        </form>
      </div>  
    </div>
  </div>

<script>
$(document).ready(function() {
  $('.mySelect2').select2();
});
</script>

@endsection