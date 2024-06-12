@extends('layouts.app')

@section('main')
<div class="main address-edit__container">
  <h1 class="address-edit__container__header header">住所の編集</h1>
  <a class="return-link" href="#" onclick="history.back()">&lsaquo;</a>
  @include('components.session')
  <form action="{{ route('address.update', $address) }}" method="post" class="address-edit__container--form form">
    @csrf
    <div class="address-edit__container--form__inner form__inner">
      <div class="form__inner-group">
        <p>郵便番号</p>
        <div class="address-edit__container--form-tag form-input--style">
          <input type="text" name="postal_code" value="{{ $address->postal_code }}">
        </div>
        <p class="error-message">@error('postal_code'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <p>住所</p>
        <div class="address-edit__container--form-tag form-input--style">
          <input type="text" name="address" value="{{ $address->address }}">
        </div>
        <p class="error-message">@error('address'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <p>建物名</p>
        <div class="address-edit__container--form-tag form-input--style">
          <input type="text" name="building_name" value="{{ $address->building_name ?? '' }}">
        </div>
        <p class="error-message">@error('building_name'){{ $message }}@enderror</p>
      </div>
    </div>
    <button class="btn--bg-pink" type="submit">変更する</button>
  </form>
</div>
@endsection