@extends('layouts.app')

@section('main')
<div class="main profile-edit__container">
  <h1 class="profile-edit__container__header header">会員登録</h1>
  <form class="profile-edit__container--form form" action="/register" method="post">
    @csrf
    <div class="profile-edit__container--form__inner form__inner">
      <div class="form__inner-group">
        <p>メールアドレス</p>
        <div class="profile-edit__container--form-tag form-input--style">
          <input type="text" name="email" value="{{ old('email') }}">
        </div>
        <p class="error-message">@error('email'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <p>パスワード</p>
        <div class="profile-edit__container--form-tag form-input--style">
          <input type="password" name="password">
        </div>
        <p class="error-message">@error('password'){{ $message }}@enderror</p>
      </div>
    </div>
    <button class="btn--bg-pink" type="submit">登録する</button>
  </form>
  <a class="auth-link blue-link" href="/login">ログインはこちら</a>
</div>
@endsection