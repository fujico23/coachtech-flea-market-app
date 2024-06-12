@extends('layouts.app')

@section('main')
<div class="main">
  <div class="link border-bottom-gray">
    <div class="link__inner">
      <a href="{{ route('index') }}">おすすめ</a>
      <a href="{{ route('favorite.index') }}" style="color: #ff5555;">マイリスト</a>
    </div>
  </div>
  <div class="item__container">
    @foreach ($favoriteItems as $item)
    <a class="item__container__card img-gray" href="{{ route('detail', $item) }}">
      <img src="" alt="">
    </a>
    @endforeach
  </div>
</div>
@endsection