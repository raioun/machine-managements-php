@extends('layouts.admin')

@section('title', 'ユーザ一覧')
@section('content')
 
<div class="text-center">
  <h1>ユーザ検索フォーム</h1>
</div>


<div class="text-center">
  <form action="{{ action('Admin\UserController@index') }}" accept-charset="UTF-8" method="get">
  
    <div class="form-group">
      <label for="name_ユーザ名">ユーザ名</label>
      <input type="text" name="name">
    </div>
      
    <div class="form-group">
      <label for="status_状態">状態</label>
      <select name="status">
        <option value="0">在籍中</option>
        <option value="1">退社済み</option>
      </select>
    </div>
    
    <div><input type="submit" value="検索" data-disable-with="検索" /></div>
  </form>
</div>

    {{--()がないと、モデルに関連付けられた他のモデルのインスタンスを返す。自身モデルのインスタンスを返す場合。
    ex:orderer内で、そのordererのorders一覧を表示したい場合 $orderer->orders; $ordererテーブルのfamily_nameを使用する場合 $orderer->family_name;
    
    ()があれば、関数を呼んだことになる。DB内の値を返すわけではない。$statusesのように、関数で定義されているのみで、DB外のデータであるもの。
    Ruby_on_Railsではこれらの区別を付けていなくても勝手に処理してくれるが、LaravelPHPではこの区別が必要--}}

<ul class="media-list">
  @foreach($users as $user)  
    <li class="media">
      <div>
        <p>ユーザ名：{{ $user->name }}</p>
      </div>
      <div>
        <p>状態：{{ $user->status_name() }}</p>
      </div>
      <div>
        <a class="btn btn-primary" href="/admin/users/show?id={{ $user->id }}">詳細</a>
      </div>
    </li>
  @endforeach
  
@endsection