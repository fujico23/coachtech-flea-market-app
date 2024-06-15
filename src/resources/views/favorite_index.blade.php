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
    @foreach ($favoriteItems as $favorite)
    <a class="item__container__card img-gray" href="{{ route('detail',  ['item' => $favorite->item->id]) }}">
      @if($favorite->item && $favorite->item->itemImages->isNotEmpty())
      <img src="{{ $favorite->item->itemImages->first()->image_url }}" alt="{{ $favorite->item->name }}" width="100%" height="100%">
      @else
      <img src="" alt="" width="100%" height="100%">
      @endif
    </a>
    @endforeach
  </div>
</div>
@endsection