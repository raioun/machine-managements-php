@extends('layouts.admin')

@section('title', '現場編集')
@section('content')

<div class="text-center">
  <h1>現場編集</h1>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
    
        <form action="{{ action('Admin\ProjectController@update') }}" method="post" enctype="multipart/form-data">
      
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
                <option value="{{ $customer->id }}" @if(old('customer_id', $project->customer_id) == $customer->id) selected="selected" @endif> {{ $customer->name }}</option>
              @endforeach
          </select>
        </div>
    
        <div class="form-group">
          <label for="project_name">現場名</label>
          <input class="form-control" type="text" value="{{ old('name', $project->name) }}" name="name" />
        </div>

        <div class="form-group">
          <label for="project_address">住所</label>
          <input class="form-control" type="text" value="{{ old('address', $project->address) }}" name="address" />
        </div>
        
        <div class="form-group">
          <label for="project_status">状態</label>
          <select class="form-control" name="status">
            <option @if(old('status', $project->status) == 0)selected="selected" @endif value="0">施工中</option>
            <option @if(old('status', $project->status) == 1)selected="selected" @endif value="1">施工済み</option>
          </select>
        </div>
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $project->id }}">
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