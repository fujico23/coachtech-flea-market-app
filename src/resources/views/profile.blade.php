@extends('layouts.app')

@section('main')
<div class="main profile-edit__container">
  <h1 class="profile-edit__container__header header">プロフィール設定</h1>
  @include('components.session')
  <form action="{{ route('profile.update') }}" method="post" class="profile-edit__container--form form">
    @csrf
    <div class="profile-edit__container__img">
      <img class="profile__image" src="" alt="">
      <button class="profile--edit btn--border-pink" href="">画像を選択する</button>
    </div>
    <div class="profile-edit__container--form__inner form__inner">
      <div class="form__inner-group">
        <p>ユーザー名</p>
        <div class="profile-edit__container--form-tag form__inner-group--input">
          <input type="text" name="name" value="{{ $user->name }}" placeholder="">
        </div>
        <p class="error-message">@error('name')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="form__inner-group">
        <p>郵便番号</p>
        <div class="profile-edit__container--form-tag form__inner-group--input">
          <input type="text" name="postal_code" value="{{ $user->postal_code }}">
        </div>
        <p class="error-message">@error('postal_code')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="form__inner-group">
        <p>住所</p>
        <div class="profile-edit__container--form-tag form__inner-group--input">
          <input type="text" name="address" value="{{ $user->address }}">
        </div>
        <p class="error-message">@error('address')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="form__inner-group">
        <p>建物</p>
        <div class="profile-edit__container--form-tag form__inner-group--input">
          <input type="text" name="building_name" value="{{ $user->building_name }}">
        </div>
        <p class="error-message">@error('building_name')
          {{ $message }}
          @enderror
        </p>
      </div>
    </div>
    <button class="btn--bg-pink" type="submit">更新する</button>
  </form>
</div>

</div>
@endsection