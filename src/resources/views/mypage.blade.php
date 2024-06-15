@extends('layouts.app')

@section('main')
<a class="return-link" href="#" onclick="history.back()">&lsaquo;</a>
<div class="main mypage__container">
  <div class="mypage__container--profile">
    <div class="mypage__container--profile__header profile">
      <img class="profile__image" src="{{ $user->icon_image ?? '' }}" alt="">
      <h1 class="profile--name">{{ $user->name }}</h1>
    </div>
    <a class="profile--edit btn--border-pink" href="{{ route('profile') }}">プロフィールを編集</a>
  </div>
  <div class="link border-bottom-gray">
    <div class="link__inner">
      <a href="{{ route('sell.show', $user) }}" style="color: #ff5555;">出品した商品</a>
      <a href="">購入した商品</a>
    </div>
  </div>
  <div class="item__container">
    @foreach($items as $item)
    <div class="item__container__card img-gray">
      <a href="{{ route('detail', $item) }}">
        @if($item->itemImages->isNotEmpty())
        <img src="{{ $item->itemImages->first()->image_url }}" alt="" width="100%" height="100%">
        @else
        <img src="" alt="" width="100%" height="100%">
        @endif
      </a>
    </div>
    @endforeach
  </div>
</div>
@endsection