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
      <button>出品した商品</button>
      <button>購入した商品</button>
    </div>
  </div>
  <div class="item__container">
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
  </div>
</div>
@endsection