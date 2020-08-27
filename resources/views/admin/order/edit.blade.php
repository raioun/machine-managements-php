@extends('layouts.admin')

@section('title', '案件編集')
@section('content')

<div class="text-center">
  <h1>注文編集</h1>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
    
        <form action="{{ action('Admin\OrderController@update') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
         
         {{-- 8/8(土)修正old --}}
          <div class="form-group">
            <label for="order_out_date">出庫日(out_date)</label>
            <input type="date" name="out_date" value="{{ old('out_date', $order->out_date) }}">
          </div>
          
          {{-- 8/8(土)修正old --}}
          <div>
            <label for="order_out_time">出庫時間</label>
            <input class="form-control" type="text" name="out_time" value="{{ old('out_time', $order->out_time) }}"/>
          </div>
          
          {{-- 8/8(土)修正old --}}
          <div class="form-group">
            <label for="order_in_date">入庫日(in_date)</label>
            <input type="date" name="in_date" value="{{ old('in_date', $order->in_date) }}">
          </div>
          
          {{-- 8/8(土)修正old --}}
          <div>
            <label for="order_in_time">入庫時間</label>
            <input class="form-control" type="text" name="in_time" value="{{ old('in_time', $order->in_time) }}"/>
          </div>
          
          {{-- 8/8(土)修正old --}}
          <div class="form-group">
            <label for="order_user_id">応対者名</label>
            <select class="mySelect2" name="user_id">
              @foreach($users as $user)
              {{-- 左 '_id'：編集後、old関数によって直前の入力が表示、右 $->id：編集前の元の状態を表示 --}}
                <option value="{{ $user->id }}" @if(old('user_id', $order->user_id) == $user->id)selected="selected" @endif>{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          
          {{-- 8/8(土)修正old --}}
          <div class="form-group">
            <label for="order_project_id">現場名</label>
            <select class="mySelect2" name="project_id">
              @foreach($projects as $project)
                <option value="{{ $project->id }}" @if(old('project_id', $order->project_id) == $project->id)selected="selected" @endif>{{ $project->customer->name }} / {{ $project->name }}</option>
              @endforeach
            </select>
          </div>
          
          {{-- 8/8(土)修正old --}}
          <div class="form-group">
            <label for="order_orderer_id">発注者名</label>
            <select class="mySelect2" name="orderer_id">
              @foreach($orderers as $orderer)
                <option value="{{ $orderer->id }}" @if(old('orderer_id', $order->orderer_id) == $orderer->id)selected="selected" @endif>{{ $orderer->customer->name }} / {{ $orderer->family_name }} {{ $orderer->first_name }}</option>
              @endforeach
            </select>
          </div>
          
          {{-- 8/8(土)修正old --}}
          <div class="form-group">
            <label for="order_rental_machine_id">機材名</label>
            <select class="mySelect2" name="rental_machine_id">
               @foreach($rental_machines as $rental_machine)
                <option value="{{ $rental_machine->id }}" @if(old('rental_machine_id', $order->rental_machine_id) == $rental_machine->id)selected="selected" @endif>{{ $rental_machine->machine->name }} / {{ $rental_machine->machine->type1 }} / {{ $rental_machine->machine->type2 }} / 機番：{{ $rental_machine->code }}</option>
              @endforeach
            </select>
          </div>
          
          {{-- 8/8(土)修正old --}}
          <div>
            <label for="order_remarks">備考</label>
            <input class="form-control" type="text" name="remarks" value="{{ old('remarks', $order->remarks) }}"/>
          </div>
          
          {{-- 8/8(土)修正old --}}
          <div class="form-group">
            <label for="order_status">状態</label>
            <select class="form-control" name="status">
              <option @if(old('status', $order->status) == 0) selected="selected" @endif value="0">予約中</option>
              <option @if(old('status', $order->status) == 1) selected="selected" @endif value="1">出庫中</option>
              <option @if(old('status', $order->status) == 2) selected="selected" @endif value="2">返却済み</option>
            </select>
          </div>
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $order->id }}">
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