@extends('layouts.admin')

@section('title', '所有営業所編集')
@section('content')

<div class="text-center">
  <h1>営業所編集</h1>
</div>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        
        <form action="{{ action('Admin\BranchController@update') }}" method="post" enctype="multipart/form-data">
          
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
      
          <div class="form-group">
            <label for="branch_company_id">所有企業名</label>
            <select class="mySelect2" name="company_id">
              @foreach($companies as $company)
                <option value="{{ $company->id }}" @if(old('company_id', $branch->company_id) == $company->id) selected="selected" @endif> {{ $company->name }}</option>
              @endforeach
            </select>
          </div>
      
          <div class="form-group">
            <label for="branch_name">所有営業所名</label>
            <input class="form-control" type="text" value="{{ old('name', $branch->name) }}" name="name"/>
          </div>
          
          <div class="form-group">
            <label for="branch_address">住所</label>
            <input class="form-control" type="text" value="{{ old('address', $branch->address) }}" name="address" />
          </div>
          {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $branch->id }}">
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