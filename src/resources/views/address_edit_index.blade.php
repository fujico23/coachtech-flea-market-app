@extends('layouts.app')

@section('main')
<div class="main address-list__container">
  <h1 class="address-list__container__header header">住所一覧</h1>
  <a class="return-link" href="#" onclick="history.back()">&lsaquo;</a>
  @include('components.session')
  <h2>登録済み住所を編集/削除する</h2>
  <a class="address-list__container--link blue-link" href="#" onclick="history.back()">完了する</a>
  @csrf
  @foreach($addresses as $address)
  @if($address)
  <div class="address-list__container__inner">
    <div class="address-list__container__inner--left">
      <div class="address-list__container__inner--address-detail">
        @if($address->type === '自宅')
        <p class="address-list__container__inner--address-detail--home-icon home-address-icon">ご自宅</p>
        @endif
        <p style="font-size: 18px;">〒{{ $address->postal_code }}</p>
        <p style="font-size: 18px;">{{ $address->address }}</p>
        <p style="font-size: 18px;">{{ $address->building_name ?? '' }}</p>
      </div>
    </div>
    <div class="address-list__container__inner--right">
      <a class="btn--border-pink--small" href="{{ route('address.edit', $address) }}">編集する</a>
      <form action="{{ route('address.destroy', $address) }}" method="post">
        @csrf
        @method('delete')
        <button class="btn--border-pink--small">削除する</button>
      </form>
    </div>
  </div>
  @endif
  @endforeach
  <a class="blue-link" href="{{ route('address.create', $address->id) }}">新しい住所を登録する</a>
  <p>※「新しい住所を登録」に郵便局/コンビニの住所を設定されても、商品を受け取ることはできません</p>
</div>
@endsection