@extends('layouts.app')

@section('main')
<a class="return-link" href="#" onclick="history.back()">&lsaquo;</a>
<div class="main purchase__container">
  <div class="purchase__container--left">
    <div class="purchase__container--left--item">
      <div class="purchase__container--left--item__img img-gray">
        @if($item->itemImages->isNotEmpty())
        <img src="{{ $item->itemImages->first()->image_url }}" alt="item" width="100%" height="100%">
        @else
        <img src="" alt="" width="100%" height="100%">
        @endif
      </div>
      <div class="purchase__container--left--item--name">
        <a href="{{ route('detail' , $item) }}">{{ $item->name }}</a>
        <p class="item__detail--price price">¥{{ number_format($item->price) }}</p>
      </div>
    </div>
    <div class="purchase__container--left--payment">
      <div class="purchase__container--left--payment__header">
        <h2>支払い方法</h2>
        <a class="blue-link" href="{{ route('purchase.select', $item) }}">変更する</a>
      </div>
      <div class="purchase__container--left--payment__list__description">
        <p>{{ $order->custom_pay_method ?? '未設定' }}</p>
        @if(isset($order) && in_array($order->pay_method, ['konbini', 'bank_transfer']))
        <p>手数料¥{{ number_format($order->fee) }}</p>
        @endif
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
        @else
        <p>未設定</p>
        @endif
      </div>
    </div>
  </div>
  <div class="purchase__container--right">
    <form id="payment-form" action="{{ route('purchase.payment.form', $item) }}" method="post">
      @csrf
      <ul class="purchase__container--right--payment border-gray">
        <li class="purchase__container--right--payment__list">
          <h3>商品代金</h3>
          <input type="text" name="amount" value="¥{{ number_format($item->price) }}" readonly>
        </li>
        <li class="purchase__container--right--payment__list">
          <h3>決済手数料</h3>
          @if(isset($order) && in_array($order->pay_method, ['konbini', 'bank_transfer']))
          <input type="text" name="fee" value="¥{{ number_format($order->fee) }}" readonly>
          @endif
        </li>
        <li class="purchase__container--right--payment__list">
          <h3>支払い金額</h3>
          @if(isset($order) && in_array($order->pay_method, ['konbini', 'bank_transfer']))
          <input type="text" name="total_amount" value="¥{{ number_format($item->price + $order->fee) }}" readonly>
          @else
          <input type="text" name="total_amount" value="¥{{ number_format($item->price) }}" readonly>
          @endif
        </li>
        <li class="purchase__container--right--payment__list">
          <h3>支払い方法</h3>
          <input type="text" name="pay_method" value="{{ $order->custom_pay_method ?? '未設定' }}" readonly>
        </li>
      </ul>
      <button class="btn--bg-pink">購入する</button>
    </form>
  </div>
</div>
@endsection