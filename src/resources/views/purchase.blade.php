@extends('layouts.app')

@section('main')
<div class="main purchase__container">
  <div class="purchase__container--left">
    <div class="purchase__container--left--item">
      <div class="purchase__container--left--item__img img-gray">
        <img src="" alt="item">
      </div>
      <div class="purchase__container--left--item--name">
        <a href="{{ route('detail' , $item) }}">{{ $item->name }}</a>
        <p class="item__detail--price price">¥{{ $item->price }}</p>
      </div>
    </div>
    <div class="purchase__container--left--payment">
      <div class="purchase__container--left--payment__header">
        <h2>支払い方法</h2>
        <a class="blue-link" href="">変更する</a>
      </div>
      <div class="purchase__container--left--payment__list__description">
        <p>カード払い</p>
        <p>手数料¥880</p>
      </div>
      <div class="purchase__container--left--payment__header">
        <h2>配送先</h2>
        <a class="blue-link" href="{{ route('address.index', $item) }}">変更する</a>
      </div>
      <div class="purchase__container--left--payment__list__description">
        @if($shippingAddress)
        <p>〒{{ $shippingAddress->postal_code }}</p>
        <p>{{ $shippingAddress->address }}</p>
        <p>{{ $shippingAddress->building_name ?? '' }}</p>
        @endif
      </div>
    </div>
  </div>
  <div class="purchase__container--right">
    <ul class="purchase__container--right--payment border-gray">
      <li class="purchase__container--right--payment__list">
        <h3>商品代金</h3>
        <p>¥{{ $item->price }}</p>
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