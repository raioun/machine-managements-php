@extends('layouts.admin')

@section('title', '保管場所一覧')
@section('content')


<ul class="media-list">
  @foreach($storages as $storage)  
    <li class="media">
      <div>
        <p>保管企業名：<a href="/admin/companies/show?id={{ $storage->company->id }}">{{ $storage->company->name }}</a></p>
      </div>
      <div>
        <p>保管営業所名：{{ $storage->name }}</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/admin/storages/show?id={{ $storage->id }}">詳細</a>
      </div>
    </li>
  @endforeach
</ul>

@endsection