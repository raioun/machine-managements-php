@extends('layouts.admin')

@section('title', '所有企業詳細')
@section('content')
      
<h1>所有企業ID：{{ $company->id }}の詳細ページ</h1>
<div>
  <p>所有企業名：{{ $company->name }}</p>
</div>
<div>
  <a class="btn btn-warning" href="/admin/companies/edit?id={{ $company->id }}">編集</a>
</div>
<div class ="text-center">
  <p><a href="/admin/companies">顧客企業一覧へ戻る</a></p>
</div>

<div class="text-center">
  <h1>この所有企業の営業所一覧</h1>
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