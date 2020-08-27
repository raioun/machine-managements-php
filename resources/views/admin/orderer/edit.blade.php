@extends('layouts.admin')

@section('title', '発注者編集')
@section('content')

<div class="text-center">
  <h1>発注者編集</h1>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        
        <form action="{{ action('Admin\OrdererController@update') }}" method="post" enctype="multipart/form-data">
          
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
                <option value="{{ $customer->id }}" @if(old('customer_id', $orderer->customer_id) == $customer->id) selected="selected" @endif> {{ $customer->name }}</option>
              @endforeach
            </select>
          </div>
      
          <div class="form-group">
            <label for="orderer_family_name">姓</label>
            <input class="form-control" type="text" value="{{ old( 'family_name', $orderer->family_name) }}" name="family_name" />
          </div>
          
          <div class="form-group">
            <label for="orderer_first_name">名</label>
            <input class="form-control" type="text" value="{{ old( 'first_name', $orderer->first_name) }}" name="first_name" />
          </div>
          
          <div class="form-group">
            <label for="orderer_phone_number">電話番号</label>
            <input class="form-control" type="text" value="{{ old( 'phone_number', $orderer->phone_number) }}" name="phone_number" />
          </div>
          
          <div class="form-group">
            <label for="orderer_status">状態</label>
            <select class="form-control" name="status">
              <option @if(old('status', $orderer->status) == 0)selected="selected" @endif value="0">在籍中</option>
              <option @if(old('status', $orderer->status) == 1)selected="selected" @endif value="1">退社済み</option>
            </select>
          </div>
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $orderer->id }}">
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