@extends('layouts.app')

@section('main')
<div class="main address-select__container">
  <h1 class="address-select__container__header header">住所一覧</h1>
  <a class="return-link" href="{{ route('purchase', $item) }}">&lsaquo;</a>
  @include('components.session')
  <h2>ご自宅/勤務先など</h2>
  <form action="{{ route('purchase.address.select', $item) }}" method="post" class="address-select__container--form form">
    @csrf
    @foreach($addresses as $address)
    @if($address)
    <div class="address-select__container--form__inner">
      <input type="radio" name="address_id" value="{{ $address->id }}" {{ $address->is_default ? 'checked' : '' }}>
      <div class="address-select__container--form__inner--address-detail">
        @if($address->type === '自宅')
        <p class="address-select__container--form__inner--address-detail--home-icon">ご自宅</p>
        <a class="blue-link" href="{{ route('profile') }}">編集</a>
        @endif
        <p>〒{{ $address->postal_code }}</p>
        <p>{{ $address->address }}</p>
        <p>{{ $address->building_name ?? '' }}</p>
      </div>
    </div>
    @endif
    @endforeach
    <a class="blue-link" href="{{ route('purchase.address.create', $item ) }}">新しい住所を登録する</a>
    <p>※「新しい住所を登録」に郵便局/コンビニの住所を設定されても、商品を受け取ることはできません</p>
    <button class="btn--bg-pink" type="submit">更新する</button>
  </form>
</div>
@endsection