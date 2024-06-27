@extends('layouts.app')

@section('main')
<a class="return-link" href="#" onclick="history.back()">&lsaquo;</a>
<div class="main favorite-index__container mg-200">
  <div class="favorite-index__container__link link border-bottom-gray">
    <a href="{{ route('index') }}">おすすめ</a>
    <a href="{{ route('favorite.index') }}" style="color: #ff5555;">マイリスト</a>
  </div>
  <div class="item__container">
    @foreach ($items as $item)
    <div class="item__container__card img-gray">
      <a href="{{ route('detail',  ['item' => $item->id]) }}">
        @if($item->itemImages->isNotEmpty())
        <img src="{{ $item->itemImages->first()->image_url }}" alt="{{ $item->name }}" width="100%" height="100%">
        @else
        <img src="https://via.placeholder.com/200/d9d9d9/fff/?text=No Image">
        @endif
      </a>
      @if($item->isSoldOut())
      <span class="soldout">SOLD OUT</span>
      @endif
    </div>
    @endforeach
  </div>
</div>
@endsection