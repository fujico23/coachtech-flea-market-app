@extends('layouts.app')

@section('main')
<div class="main comment__container">
  <div class="item__image img-gray">
    <img src="" alt="item">
  </div>
  <div class="item__detail">
    <h1>商品名</h1>
    <p>ブランド名</p>
    <p class="item__detail--price price">¥47,000（値段）</p>
    <div class="item__detail--icon icon">
      <form class="star" method="post" action="">
        @csrf
        <input type="image" src="{{ asset('img/star.svg') }}" alt="いいね" width="32px" height="32px">
        <p>3</p>
      </form>
      <div class="comment">
        <a class="" href="{{ route('comment') }}">
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
    <button class="btn--bg-pink" href="{{ route('purchase') }}">コメントを送信する
    </button>
  </div>
</div>
@endsection