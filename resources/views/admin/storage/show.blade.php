@extends('layouts.admin')

@section('title', '保管場所詳細')
@section('content')

<h1>所有営業所ID：{{ $storage->id }} の詳細ページ</h1>
<div>
  <p>顧客企業名：<a href="/admin/companies/show?id={{ $storage->company->id }}">{{ $storage->company->name }}</a></p>
</div>
<div>
  <p>所有営業所名：{{ $storage->name }}</p>
</div>
<div>
  <p>住所：{{ $storage->address }}</p>
</div>
<div>
  <a class="btn btn-warning" href="/admin/storages/edit?id={{ $storage->id }}">編集</a>
</div>
<div class ="text-center">
  <p><a href="/admin/storages">保管場所一覧へ戻る</a></p>
</div>

@endsection