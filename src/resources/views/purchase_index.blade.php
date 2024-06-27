@extends('layouts.app')

@section('main')
<div class="re">
  <a class="return-link" href="#" onclick="history.back()">&lsaquo;</a>
</div>
<div class="main mypage__container">
  <div class="mypage__container--profile">
    <div class="mypage__container--profile__inner">
      <div class="mypage__container--profile__header profile">
        <img class="profile__image" src="{{ $user->icon_image ?? '' }}" alt="">
        <h1 class="profile--name">{{ $user->name }}</h1>
      </div>
      <a class="profile--edit btn--border-pink" href="{{ route('profile') }}">プロフィールを編集</a>
    </div>
  </div>
  <div class="mypage__container__link link border-bottom-gray">
    <a href="{{ route('sell.show', $user) }}">出品した商品</a>
    <a href="{{ route('purchase.index', $user) }}" style="color: #ff5555;">購入した商品</a>
  </div>
  <div class="item__container">
    @foreach($items as $item)
    <div class="item__container__card img-gray">
      <a href="{{ route('detail', $item) }}">
        @if($item->itemImages && $item->itemImages->isNotEmpty())
        <img src="{{ $item->itemImages->first()->image_url }}" alt="" width="100%" height="100%">
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