@extends('layouts.admin')

@section('title', '機材名一覧')
@section('content')

<div class="text-center">
  <h1>機材名検索フォーム</h1>
</div>

<div class="text-center">
  <form action="{{ action('Admin\MachineController@index') }}" accept-charset="UTF-8" method="get">
    
    <div class="form-group">
      <label for="name_機材名">機材名</label>
      <input type="text" name="name">
    </div>
    
    <div class="form-group">
      <label for="type1_型式1">型式1</label>
      <input type="text" name="type1">
    </div>
    
    <div class="form-group">
      <label for="type2_型式2">型式2</label>
      <input type="text" name="type2">
    </div>
    
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

<ul class="media-list">
  @foreach($machines as $machine)  
    <li class="media">
      <div>
        <p>機材名：{{ $machine->name }}/{{ $machine->type1 }}/{{ $machine->type2 }}</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/admin/machines/show?id={{ $machine->id }}">詳細</a>
      </div>
    </li>
  @endforeach
</ul>

@endsection