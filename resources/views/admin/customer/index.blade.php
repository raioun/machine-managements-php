@extends('layouts.admin')

@section('title', '顧客企業一覧')
@section('content')
      
<div class="text-center">
  <h1>顧客検索フォーム</h1>
</div>

<div class="text-center">
  <form action="{{ action('Admin\CustomerController@index') }}" accept-charset="UTF-8" method="get">
  
    <div class="form-group">
      <label for="customer_顧業名">顧客企業名</label>
      <input type="text" name="name" value="@if(isset($inputs['name'])){{ $inputs['name'] }}@endif">
    </div>
    
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

<ul class="media-list">
  @foreach($customers as $customer)  
    <li class="media">
      <div>
        <p>顧客企業名：{{ $customer->name }}</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/admin/customers/show?id={{ $customer->id }}">詳細</a>
      </div>
    </li>
  @endforeach
</ul>

@endsection