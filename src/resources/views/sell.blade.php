@extends('layouts.app')

@section('main')
<div class="main sell-edit__container">
  <h1 class="sell-edit__container__header header">商品の出品</h1>
  <form action="" class="sell-edit__container--form form">
    @csrf
    <div class="sell-edit__container--form__inner form__inner">
      <div class="form__inner-group">
        <p>商品画像</p>
        <div class="sell-edit__container--form-tag form__inner-group--input input-file">
          <input class="sell-edit__container--form-tag--file" type="file" name="">
        </div>
        <p class="auth-error">@error('')
          {{ $message }}
          @enderror
        </p>
      </div>
      <h2>商品の詳細</h2>
      <div class="form__inner-group">
        <p>カテゴリー</p>
        <div class="sell-edit__container--form-tag form__inner-group--input">
          <input type="text" name="">
        </div>
        <p class="auth-error">@error('')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="form__inner-group">
        <p>商品の状態</p>
        <div class="sell-edit__container--form-tag form__inner-group--input">
          <input type="text" name="" value="">
        </div>
        <p class="auth-error">@error('')
          {{ $message }}
          @enderror
        </p>
      </div>
      <h2 class="border-bottom-gray">商品名と説明</h2>
      <div class="form__inner-group">
        <p>商品名</p>
        <div class="sell-edit__container--form-tag form__inner-group--input">
          <input type="text">
        </div>
        <p class="auth-error">@error('')
          {{ $message }}
          @enderror
        </p>
      </div>
      <div class="form__inner-group">
        <p>商品の説明</p>
        <textarea rows="4"></textarea>
        <p class="auth-error">@error('')
          {{ $message }}
          @enderror
        </p>
      </div>
      <h2 class="border-bottom-gray">販売価格</h2>
      <div class="form__inner-group">
        <p>販売価格</p>
        <div class="sell-edit__container--form-tag form__inner-group--input">
          <input type="text">
        </div>
        <p class="auth-error">@error('')
          {{ $message }}
          @enderror
        </p>
      </div>
    </div>
  </form>
  <button class="btn--bg-pink">更新する</button>
</div>

</div>
@endsection