@extends('layouts.app')

@section('main')
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
      <a href="{{ route('sell.show', $user) }}">出品した商品</a>
      <button>購入した商品</button>
    </div>
  </div>
  <div class="item__container">
    @foreach($items as $item)
    <div class="item__container__card img-gray">
      <a href="{{ route('detail', $item) }}">
        <img src="{{ $item->itemImages->first()->image_url }}" alt="" width="100%" height="100%">
      </a>
    </div>
    @endforeach
    <!-- <div class="item__container__card img-gray">
      <a href="/item/item_id">
        <img src="" alt="">
      </a>
    </div>
    <div class="item__container__card img-gray">
      <a href="/item/item_id">
        <img src="" alt="">
      </a>
    </div>
    <div class="item__container__card img-gray">
      <a href="/item/item_id">
        <img src="" alt="">
      </a>
    </div>
    <div class="item__container__card img-gray">
      <a href="/item/item_id">
        <img src="" alt="">
      </a>
    </div>
    <div class="item__container__card img-gray">
      <a href="/item/item_id">
        <img src="" alt="">
      </a>
    </div>
    <div class="item__container__card img-gray">
      <a href="/item/item_id">
        <img src="" alt="">
      </a>
    </div> -->
  </div>
</div>
@endsection