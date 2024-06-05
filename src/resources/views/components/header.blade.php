<header>
  <div class="header__left">
    <div class="header__left__inner">
      <img src="{{ asset('img/logo.svg') }}" alt="logo">
    </div>
    <div class="header__left--input input">
      <input type="text" placeholder="なにをお探しですか？">
    </div>
  </div>
  @if (Auth::check())
  <div class="header__right">
    <form action="/logout" method="post">
      @csrf
      <button class="logout">ログアウト</button>
    </form>
    <a href="{{ route('mypage') }}">マイページ</a>
    <a class="" href="{{ route('sell') }}">出品</a>
  </div>
  @else
  <div class="header__right">
    <a href="/login">ログイン</a>
    <a href="/register">会員登録</a>
  </div>
  @endif
</header>