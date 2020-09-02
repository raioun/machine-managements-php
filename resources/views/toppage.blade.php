@extends('layouts.admin')

@section('title', '機材別管理表トップページ')
@section('content')


<div  class="text-right">
  {{-- <p>ユーザ名: {{ Auth::user()->name }}</p> --}}
</div>
  <div class="text-center">
    <div class="link">
      {{--<a class="btn btn-lg btn-info" href="/admin/users/create">新規ユーザ登録</a> registerはログアウト状態でないと作成できないようになっているため--}}
      <a class="btn btn-lg btn-success" href="/admin/users">ユーザ一覧</a>
    </div>
    <div class="link">
      <a class="btn btn-lg btn-info" href="/admin/customers/create">新規顧客企業登録</a>
      <a class="btn btn-lg btn-success" href="/admin/customers">顧客企業一覧</a>
    </div>
    <div class="link">
      <a class="btn btn-lg btn-info" href="/admin/projects/create">新規現場登録</a>
      <a class="btn btn-lg btn-success" href="/admin/projects">現場一覧</a>
    </div>
    <div class="link">
      <a class="btn btn-lg btn-info" href="/admin/orderers/create">新規発注者登録</a>
      <a class="btn btn-lg btn-success" href="/admin/orderers">発注者一覧</a>
    </div>
    <div class="link">
      <a class="btn btn-lg btn-info" href="/admin/companies/create">新規所有企業登録</a>
      <a class="btn btn-lg btn-success" href="/admin/companies">所有企業一覧</a>
    </div>
    <div class="link">
      <a class="btn btn-lg btn-info" href="/admin/branches/create">新規営業所登録</a>
      <a class="btn btn-lg btn-success" href="/admin/branches">営業所一覧</a>
    </div>
    <div class="link">
      <a class="btn btn-lg btn-info" href="/admin/machines/create">新規機材名登録</a>
      <a class="btn btn-lg btn-success" href="/admin/machines">機材名一覧</a>
    </div>
    <div class="link">
      <a class="btn btn-lg btn-info" href="/admin/rental_machines/create">新規機材登録</a>
      <a class="btn btn-lg btn-success" href="/admin/rental_machines">機材一覧</a>
    </div>
    <div class="link">
      <a class="btn btn-lg btn-success" href="/admin/orders">案件一覧</a>
    </div>
  </div>

@endsection