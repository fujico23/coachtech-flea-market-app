@extends('layouts.app')

@section('main')
<div class="main comment__container">
  <div class="item__image img-gray">
    <img src="" alt="item">
  </div>
  <div class="item__detail">
    <h1>
      <a href="{{ route('detail', $item) }}">{{ $item->name }}</a>
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
    <ul class="item__detail--comment">
      <li class="item__detail--comment__list">
        <div class="item__detail--comment__list--user">
          <img class="profile__image comment__user-img" src="" alt="">
          <p>名前</p>
        </div>
        <p class="item__detail--comment__list--text img-gray">コメントコメント</p>
      </li>
      <li class="item__detail--comment__list">
        <div class="item__detail--comment__list--user">
          <img class="profile__image comment__user-img" src="" alt="">
          <p>名前</p>
        </div>
        <p class="item__detail--comment__list--text img-gray">コメントコメント</p>
      </li>
      <li class="item__detail--comment__list">
        <div class="item__detail--comment__list--user">
          <img class="profile__image comment__user-img" src="" alt="">
          <p>名前</p>
        </div>
        <p class="item__detail--comment__list--text img-gray">コメントコメント</p>
      </li>
    </ul>
    <h2 class="item__detail--comment__form-header">商品のコメント</h2>
    <form action="" class="item__detail--comment__form">
      @csrf
      <textarea class="item__detail--comment__form-textarea" name="" id="" textarea rows="4"></textarea>
    </form>
    <button class="btn--bg-pink" href="{{ route('comment.store',$item) }}">コメントを送信する
    </button>
  </div>
</div>
@endsection