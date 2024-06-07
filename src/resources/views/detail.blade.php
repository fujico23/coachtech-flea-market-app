@extends('layouts.app')

@section('main')
<div class="main detail__container">
  <div class="item__image img-gray">
    <img src="" alt="item">
  </div>
  <div class="item__detail">
    <h1>
      <a href="">{{ $item->name }}</a>
    </h1>
    <p>{{ $item->brand->name }}</p>
    <p class="item__detail--price price">¥{{ $item->price }}（値段）</p>
    <div class="item__detail--icon icon">
      @if(!$item->isFavoriteByAuthUser())
      <form class="star" method="post" action="{{ route('favorite.add', $item) }}">
        @csrf
        <input type="image" src="{{ asset('img/star.svg') }}" alt="いいね" width="32px" height="32px">
        <p>{{ $item->favorites_count }}</p>
      </form>
      @else
      <form class="star" method="post" action="{{ route('favorite.destroy', $item) }}">
        @csrf
        @method('delete')
        <input type="image" src="{{ asset('img/star-yellow.svg') }}" alt="いいね" width="32px" height="32px">
        <p>{{ $item->favorites_count }}</p>
      </form>
      @endif
      <div class="comment">
        <a class="" href="{{ route('comment', $item) }}">
          <img src="{{ asset('img/comment.svg') }}" alt="logo" width="32px" height="32px">
        </a>
        <p>14</p>
      </div>
    </div>
    <a class="btn--bg-pink" href="{{ route('purchase', $item) }}">購入する</a>
    <h2>商品説明</h2>
    <div class="item__detail--description">
      <p>カラー：{{ $item->color->name }}</p>
      <div class="item__detail--description--text">
        <span>{{ $item->description }}</span>
      </div>
    </div>
    <h2>商品の情報</h2>
    <div class="item__detail--info">
      <div class="item__detail--info--category">
        <h3>カテゴリー</h3>
        <p class="img-gray">{{ $item->category->parent->name }}</p>
        <p class="img-gray">{{ $item->category->name }}</p>
      </div>
      <div class="item__detail--info--condition">
        <h3>商品の状態</h3>
        <p>{{ $item->condition->name }}</p>
      </div>
    </div>
  </div>
</div>
@endsection