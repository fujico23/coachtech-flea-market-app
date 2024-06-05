@extends('layouts.app')

@section('main')
<div class="main">
  <div class="link border-bottom-gray">
    <div class="link__inner">
      <button>おすすめ</button>
      <button>マイリスト</button>
    </div>
  </div>
  <div class="item__container">
    <div class="item__container__card img-gray">
      <a href="{{ route('detail') }}">
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