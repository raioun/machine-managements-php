@extends('layouts.admin')

@section('title', '新規発注者登録')
@section('content')

<div class="text-center">
  <h1>新規発注者登録</h1>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
    
        <form action="{{ action('Admin\OrdererController@create') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
       
            <div class="form-group">
              <label for="orderer_customer_id">顧客企業名</label>
              <select class="mySelect2" name="customer_id">
                @foreach($customers as $customer)
                  <option @if(old('customer_id') == $customer->id) selected="selected" @endif value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
              </select>
            </div>
        
            <div class="form-group">
              <label for="orderer_family_name">姓</label>
              <input class="form-control" type="text" name="family_name" value="{{ old('family_name') }}" />
            </div>
            
            <div class="form-group">
              <label for="orderer_first_name">名</label>
              <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" />
            </div>
            
            <div class="form-group">
              <label for="orderer_phone_number">電話番号</label>
              <input class="form-control" type="text" name="phone_number" value="{{ old('phone_number') }}" />
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