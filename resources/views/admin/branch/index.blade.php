@extends('layouts.admin')

@section('title', '所有営業所一覧')
@section('content')
      
<div class="text-center">
  <h1>所有営業所検索フォーム</h1>
</div>

<div class="text-center">
  <form action="{{ action('Admin\BranchController@index') }}" accept-charset="UTF-8" method="get">
  
    <div class="form-group">
      <label for="company_所有企業名">所有企業名</label>
      <input type="text" name="company" id="company" />
    </div>
    
    <div class="form-group">
      <label for="branch_所有営業所名">所有営業所名</label>
      <input type="text" name="name">
    </div>
    
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

<ul class="media-list">
  @foreach($branches as $branch)  
    <li class="media">
      <div>
        <p>所有企業名：<a href="/admin/companies/show?id={{ $branch->company->id }}">{{ $branch->company->name }}</a></p>
      </div>
      <div>
        <p>所有営業所名：{{ $branch->name }}</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/admin/branches/show?id={{ $branch->id }}">詳細</a>
      </div>
    </li>
  @endforeach
</ul>

@endsection