<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>flea-market</title>
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body>
  <div class="main verification__container">
    <h1 class="verification__container__header header">メールアドレスの確認</h1>
    @if (session('resent'))
    <div class="alert alert-success" role="alert">
      {{ __('あなたのEメールアドレスに新しい認証リンクが送信されました。') }}
    </div>
    @endif
    <div class="verification__container__inner">
      <p>{{ __('入力したメールアドレスに確認メールが届いていないかをご確認ください。') }}</p>
      <p>{{ __('メールが届かない場合') }}</p>
      <p>{{ __('下のリンクをクリックして再度メールをリクエストして下さい。') }}</p>
      <form class="" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <div class="verification__container__btn-group">
          <button class="btn--border-pink--small" type="submit">{{ __('click here to request another') }}</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>