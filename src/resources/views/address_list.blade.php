@extends('layouts.app')

@section('main')
<a class="return-link" href="{{ route('purchase', $item) }}">&lsaquo;</a>
<div class="main address-select__container">
  <h1 class="address-select__container__header header">住所一覧</h1>
  @include('components.session')
  <h2>配送先を選択する</h2>
  @if($addressExists)
  <a class="address-select__container--link blue-link" href="{{ route('address.edit.index',$item) }}">編集する</a>
  @endif
  <form action="{{ route('address.select', $item) }}" method="post" class="address-select__container--form form">
    @csrf
    @foreach($addresses as $address)
    @if($address)
    <label class="address-select__container__inner" style="display: block; cursor: pointer;">
      <div class="address-select__container__inner">
        <input type="radio" name="address_id" value="{{ $address->id }}" {{ $address->is_default ? 'checked' : '' }}>
        <div class="address-select__container__inner--address-detail">
          @if($address->type === '自宅')
          <p class="address-select__container__inner--address-detail--home-icon home-address-icon">ご自宅</p>
          @endif
          <p style="font-size: 18px;">〒{{ $address->postal_code }}</p>
          <p style="font-size: 18px;">{{ $address->address }}</p>
          <p style="font-size: 18px;">{{ $address->building_name ?? '' }}</p>
        </div>
      </div>
    </label>
    @endif
    @endforeach
    <a class="blue-link" href="{{ route('address.create', $item ) }}">新しい住所を登録する</a>
    <p>※「新しい住所を登録」に郵便局/コンビニの住所を設定されても、商品を受け取ることはできません</p>
    @if($addressExists)
    <button class="btn--bg-pink" type="submit">更新する</button>
    @endif
  </form>
</div>
@endsection