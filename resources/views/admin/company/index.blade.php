@extends('layouts.admin')

@section('title', '所有企業一覧')
@section('content')

<div class="text-center">
  <h1>所有企業検索フォーム</h1>
</div>

<div class="text-center">
  <form action="{{ action('Admin\CompanyController@index') }}" accept-charset="UTF-8" method="get">
  
    <div class="form-group">
      <label for="company_所有企業名">所有企業名</label>
      <input type="text" name="name" value="@if(isset($inputs['name'])){{ $inputs['name'] }}@endif"/>
    </div>
    
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

<ul class="media-list">
  @foreach($companies as $company)
    <li class="media">
      <div>
        <p>所有企業名：{{ $company->name }}</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/admin/companies/show?id={{ $company->id }}">詳細</a>
      </div>
    </li>
  @endforeach
</ul>

@endsection