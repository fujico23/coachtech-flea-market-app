@extends('layouts.app')

@section('main')
<div class="main detail__container">
  <div class="item__image img-gray">
    <img src="" alt="item">
  </div>
  <div class="item__detail">
    <h1>
      <a href="">商品名</a>
    </h1>
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
    <a class="btn--bg-pink" href="{{ route('purchase') }}">購入する</a>
    <h2>商品説明</h2>
    <div class="item__detail--description">
      <p>カラー：グレー</p>
      <div class="item__detail--description--text">
        <span>新品。商品の状態は良好です。傷もありません。購入後、即発送いたします。</span>
      </div>
    </div>
    <h2>商品の情報</h2>
    <div class="item__detail--info">
      <div class="item__detail--info--category">
        <h3>カテゴリー</h3>
        <p class="img-gray">洋服</p>
        <p class="img-gray">メンズ</p>
      </div>
      <div class="item__detail--info--condition">
        <h3>商品の状態</h3>
        <p>良好</p>
      </div>
    </div>
  </div>
</div>
@endsection