@extends('layouts.app')

@section('main')
<div class="main address-edit__container">
  <h1 class="address-edit__container__header header">住所の変更</h1>
  <a class="return-link" href="{{ route('purchase.address.update', $item) }}">&lsaquo;</a>
  @include('components.session')
  <form action="{{ route('purchase.address.store', $item) }}" method="post" class="address-edit__container--form form">
    @csrf
    <div class="address-edit__container--form__inner form__inner">
      <div class="form__inner-group">
        <p>郵便番号</p>
        <div class="address-edit__container--form-tag form-input--style">
          <input type="text" name="postal_code" value="">
        </div>
        <p class="error-message">@error('postal_code'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <p>住所</p>
        <div class="address-edit__container--form-tag form-input--style">
          <input type="text" name="address" value="">
        </div>
        <p class="error-message">@error('address'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <p>建物名</p>
        <div class="address-edit__container--form-tag form-input--style">
          <input type="text" name="building_name" value="">
        </div>
        <p class="error-message">@error('building_name'){{ $message }}@enderror</p>
      </div>
    </div>
    <button class="btn--bg-pink" type="submit">追加する</button>
  </form>
</div>
@endsection