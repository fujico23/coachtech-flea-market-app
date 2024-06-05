@extends('layouts.app')

@section('main')
<div class="main purchase__container">
  <div class="purchase__container--left">
    <div class="purchase__container--left--item">
      <div class="purchase__container--left--item__img img-gray">
        <img src="" alt="item">
      </div>
      <div class="purchase__container--left--item--name">
        <h1>商品名</h1>
        <p class="item__detail--price price">¥47,000</p>
      </div>
    </div>
    <ul class="purchase__container--left--payment">
      <li class="purchase__container--left--payment__list">
        <h2>支払い方法</h2>
        <a class="blue-link" href="">変更する</a>
      </li>
      <li class="purchase__container--left--payment__list">
        <h2>配送先</h2>
        <a class="blue-link" href="{{ route('address') }}">変更する</a>
      </li>
    </ul>
  </div>
  <div class="purchase__container--right">
    <ul class="purchase__container--right--payment border-gray">
      <li class="purchase__container--right--payment__list">
        <h3>商品代金</h3>
        <p>¥47,000</p>
      </li>
      <li class="purchase__container--right--payment__list">
        <h3>商品代金</h3>
        <p>¥47,000</p>
      </li>
      <li class="purchase__container--right--payment__list">
        <h3>支払い金額</h3>
        <p>¥47,000</p>
      </li>
      <li class="purchase__container--right--payment__list">
        <h3>支払い方法</h3>
        <p>コンビニ払い</p>
      </li>
    </ul>
    <a class="btn--bg-pink" href="">購入する</a>
  </div>
</div>
@endsection