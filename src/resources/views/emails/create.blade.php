@extends('layouts/app')

@section('main')
<a class="return-link" href="#" onclick="history.back()">&lsaquo;</a>
<div class="main profile-edit__container">
  <h1 class="header admin-header">Send Mail</h1>
  @include('components.session')
  <form action="{{ route('mail.send', $user) }}" method="post">
    @csrf
    <div class="form__inner mail__group">
      <div class="mail__group--item">
        <p class="default">default</p>
        <h2 class="mail__group-p">{{ $user->name }} 様 </h2>
        <p class="mail__group-p">いつもcoachtechフリマのご利用、誠にありがとうございます。 </p>
      </div>
      <div class="mail__group-textarea">
        <label for="content">メール入力フォーム<span class="required">必須</span></label>
        <textarea name="content" id=""></textarea>
      </div>
      <div class="mail__group--item">
        <p class="default">default</p>
        <p class="mail__group-p">今後もご活用の程、何卒宜しくお願いいたします。 </p>
        <p class="mail__group-p">-coachtechフリマ- </p>
      </div>
    </div>
    <button class="btn--bg-pink" type="submit">メール送信</button>
  </form>
</div>
@endsection