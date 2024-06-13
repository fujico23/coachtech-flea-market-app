@extends('layouts.app')

@section('main')
<div class="main profile-edit__container">
  <h1 class="profile-edit__container__header header">ログイン</h1>
  <form class="profile-edit__container--form form" action="{{ route('login') }}" method="post">
    @csrf
    <div class="profile-edit__container--form__inner form__inner">
      <div class="form__inner-group">
        <p>メールアドレス</p>
        <div class="profile-edit__container--form-tag form-input--style">
          <input type="email" name="email" value="{{ old('email') }}">
        </div>
        <p class="error-message">@error('email'){{ $message }}@enderror
        </p>
      </div>
      <div class="form__inner-group">
        <p>パスワード</p>
        <div class="profile-edit__container--form-tag form-input--style">
          <input type="password" name="password">
        </div>
        <p class="error-message">@error('password'){{ $message }}@enderror
        </p>
      </div>
    </div>
    <button class="btn--bg-pink" type="submit">ログインする</button>
  </form>
  <a class="auth-link blue-link" href="{{ route('register') }}">会員登録はこちら</a>
</div>
@endsection