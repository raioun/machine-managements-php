@extends('layouts.admin')

@section('title', '新規レンタル機材登録')
@section('content')
      
<div class="text-center">
  <h1>新規機材登録</h1>
</div>


  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
    
        <form action="{{ action('Admin\RentalMachineController@create') }}" method="post" enctype="multipart/form-data">
          
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
                <option @if(old('machine_id') == $machine->id) selected="selected" @endif value="{{ $machine->id }}">{{ $machine->name }} / {{ $machine->type1 }} / {{ $machine->type2 }}</option>
              @endforeach
            </select>
          </div>
          
          <div class="form-group">
            <label for="rental_machine_branch_id">所有営業所名</label>
            <select class="mySelect2" name="branch_id">
              @foreach($branches as $branch)
                <option @if(old('branch_id') == $branch->id) selected="selected" @endif value="{{ $branch->id }}">{{ $branch->company->name }} / {{ $branch->name }}</option>
              @endforeach
            </select>
          </div>
          
          <div class="form-group">
            <label for="rental_machine_storage_id">保管場所</label>
            <select class="mySelect2" name="storage_id">
              @foreach($storages as $storage)
                <option @if(old('storage_id') == $storage->id) selected="selected" @endif value="{{ $storage->id }}">{{ $storage->company->name }} / {{ $storage->name }}</option>
              @endforeach
            </select>
          </div>
          
          <div class="form-group">
            <label for="rental_machine_code">機番</label>
            <input class="form-control" type="text" name="code" value="{{ old('code') }}"/>
          </div>
          
          <div class="form-group">
            <label for="rental_machine_remarks">備考</label>
            <input class="form-control" type="text" name="remarks" value="{{ old('remarks') }}"/>
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