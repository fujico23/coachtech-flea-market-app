@extends('layouts.app')

@section('main')
<a class="return-link" href="{{ route('purchase', $item) }}">&lsaquo;</a>
<div class="main address-select__container">
  <h1 class="address-select__container__header header">支払い方法</h1>
  @include('components.session')
  <h2>支払い方法を選択する</h2>
  <form action="{{ route('purchase.update.payment', $item) }}" method="post" class="address-select__container--form form" onsubmit="return confirm('本当に変更しますか？');">
    @csrf
    <label class="address-select__container__inner" style="display: block; cursor: pointer;">
      <div class="address-select__container__inner">
        <input type="radio" name="pay_method" value="card">
        <div class="address-select__container__inner--address-detail">
          <p style="font-size: 18px;">クレジットカード決済</p>
          <p style="font-size: 18px;">手数料¥0</p>
        </div>
      </div>
    </label>
    <label class="address-select__container__inner" style="display: block; cursor: pointer;">
      <div class="address-select__container__inner">
        <input type="radio" name="pay_method" value="konbini">
        <div class="address-select__container__inner--address-detail">
          <p style="font-size: 18px;">コンビニ</p>
          <p style="font-size: 18px;">手数料¥100-¥880</p>
        </div>
      </div>
    </label>
    <label class="address-select__container__inner" style="display: block; cursor: pointer;">
      <div class="address-select__container__inner">
        <input type="radio" name="pay_method" value="customer_balance">
        <div class="address-select__container__inner--address-detail">
          <p style="font-size: 18px;">銀行振込</p>
          <p style="font-size: 18px;">手数料¥100-¥880</p>
        </div>
      </div>
    </label>
    <button class="btn--bg-pink" type="submit">更新する</button>
  </form>
</div>
@endsection