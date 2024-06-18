<header>
  <div class="header__left">
    <div class="header__left__logo">
      <a href="{{ route('index') }}">
        <img src="{{ asset('img/logo.svg') }}" alt="logo">
      </a>
    </div>
    <div class="header__left--input input">
      <form class="header__left--input__inner" method="get" action="{{ route('search') }}">
        @csrf
        <input type="text" name="keyword" placeholder="なにをお探しですか？">
        <button type="submit"><img src="{{ asset('img/magnifying-glass-solid.svg') }}" alt="" width="55%" height="55%"></button>
      </form>
    </div>
  </div>
  @if (Auth::check())
  @if( Auth::user()->role_id === 1 )
  <div class="header__right">
    <form action="/logout" method="post">
      @csrf
      <button class="logout">ログアウト</button>
    </form>
    <a href="{{ route('mypage') }}">マイページ</a>
    <a href="{{ route('admin.index') }}">管理</a>
    <a class="" href="{{ route('sell') }}">出品</a>
  </div>
  @else( Auth::user()->role_id === 2 )
  <div class="header__right">
    <form action="/logout" method="post">
      @csrf
      <button class="logout">ログアウト</button>
    </form>
    <a href="{{ route('mypage') }}">マイページ</a>
    <a class="" href="{{ route('sell') }}">出品</a>
  </div>
  @endif
  @else
  <div class="header__right">
    <a href="/login">ログイン</a>
    <a href="/register">会員登録</a>
  </div>
  @endif
</header>