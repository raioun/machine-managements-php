@extends('layouts.admin')

@section('title', 'レンタル機材編集')
@section('content')

<div class="text-center">
  <h1>機材編集</h1>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
    
        <form action="{{ action('Admin\RentalMachineController@update') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
      
          <div class="form-group">
            <label for="rental_machine_machine_id">機材名</label>
            <select class="mySelect2" name="machine_id">
              @foreach($machines as $machine)
                <option value="{{ $machine->id }}" @if(old('machine_id', $rental_machine->machine_id) == $machine->id)selected="selected" @endif>{{ $machine->name }} / {{ $machine->type1 }} / {{ $machine->type2 }}</option>
              @endforeach
            </select>
          </div>
          
          <div class="form-group">
            <label for="rental_machine_branch_id">所有営業所名</label>
            <select class="mySelect2" name="branch_id">
              @foreach($branches as $branch)
                <option value="{{ $branch->id }}" @if(old('branch_id', $rental_machine->branch_id) == $branch->id)selected="selected" @endif>{{ $branch->company->name }} / {{ $branch->name }}</option>
              @endforeach
            </select>
          </div>
          
          <div class="form-group">
            <label for="rental_machine_storage_id">保管場所</label>
            <select class="mySelect2" name="storage_id">
              @foreach($storages as $storage)
                <option value="{{ $storage->id }}" @if(old('storage_id', $rental_machine->storage_id) == $storage->id)selected="selected" @endif>{{ $storage->company->name }} / {{ $storage->name }}</option>
              @endforeach
            </select>
          </div>
          
          <div class="form-group">
            <label for="rental_machine_code">機番</label>
            <input class="form-control" type="text" value="{{ old('code', $rental_machine->code) }}" name="code" />
          </div>
          
          <div class="form-group">
            <label for="rental_machine_remarks">備考</label>
            <input class="form-control" type="text" value="{{ old('remarks', $rental_machine->remarks) }}" name="remarks"/>
          </div>
          
          <div class="form-group">
            <label for="rental_machine_status">状態</label>
            <select class="form-control" name="status">
              <option @if(old('status', $rental_machine->status) == 0)selected="selected" @endif value="0">良品</option>
              <option @if(old('status', $rental_machine->status) == 1)selected="selected" @endif value="1">重整備</option>
              <option @if(old('status', $rental_machine->status) == 2)selected="selected" @endif value="2">廃棄済み</option>
            </select>
          </div>
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $rental_machine->id }}">        
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