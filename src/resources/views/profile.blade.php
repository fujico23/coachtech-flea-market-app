@extends('layouts.app')

@section('main')
<a class="return-link" href="{{ route('mypage') }}">&lsaquo;</a>
<div class="main profile-edit__container">
  <h1 class="profile-edit__container__header header">プロフィール設定</h1>
  @include('components.session')
  <form action="{{ route('profile.update') }}" method="post" class="profile-edit__container--form form" enctype="multipart/form-data">
    @csrf
    <div class="profile-edit__container__img">
      <img id="profileImage" class="profile__image" src="{{ $user->icon_image ?? '' }}" alt="">
      <label for="icon_image" class="custom-file-label btn--border-pink">画像を選択</label>
      <input id="icon_image" type="file" class="profile--edit custom-file-input" name="icon_image">
      <p class="error-message">@error('icon_image'){{ $message }}@enderror</p>
    </div>
    <div class="profile-edit__container--form__inner form__inner">
      <div class="form__inner-group">
        <div class="form__inner-group--tag">
          <p class="form__inner-group--tag__header">ユーザー名</p>
          <p class="form__inner-group--tag__required required">必須</p>
        </div>
        <div class="profile-edit__container--form-tag form-input--style">
          <input type="text" name="name" value="{{ $user->name ?? ''}}" placeholder="">
        </div>
        <p class="error-message">@error('name'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <div class="form__inner-group--tag">
          <p class="form__inner-group--tag__header">郵便番号</p>
          <p class="form__inner-group--tag__required required">必須</p>
        </div>
        <div class="profile-edit__container--form-tag form-input--style">
          <input type="text" name="postal_code" value="{{ $homeAddress->postal_code ?? '' }}">
        </div>
        <p class="error-message">@error('postal_code'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <div class="form__inner-group--tag">
          <p>住所</p>
          <p class="form__inner-group--tag__required required">必須</p>
        </div>
        <div class="profile-edit__container--form-tag form-input--style">
          <input type="text" name="address" value="{{ $homeAddress->address ?? '' }}">
        </div>
        <p class="error-message">@error('address'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <div class="form__inner-group--tag">
          <p>建物名</p>
          <p class="form__inner-group--tag__required"></p>
        </div>
        <div class="profile-edit__container--form-tag form-input--style">
          <input type="text" name="building_name" value="{{ $homeAddress->building_name ?? '' }}">
        </div>
        <p class="error-message">@error('building_name'){{ $message }}@enderror</p>
      </div>
      <input type="hidden" name="type" value="自宅">
    </div>
    <button class="btn--bg-pink" type="submit">更新する</button>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('icon_image');
    const fileLabel = document.querySelector('.custom-file-label');

    document.getElementById('icon_image').addEventListener('change', function(event) {
      const [file] = event.target.files;
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('profileImage').src = e.target.result;
        }
        reader.readAsDataURL(file);
      }
    });
  });
</script>
@endsection