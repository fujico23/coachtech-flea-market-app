@extends('layouts.app')

@section('main')
<div class="main">
  <div class="link border-bottom-gray">
    <div class="link__inner">
      <button>おすすめ</button>
      <button>マイリスト</button>
    </div>
  </div>
  <div class="item__container">
    @foreach ($items as $item)
    <a class="item__container__card img-gray" href="{{ route('detail', $item) }}">
      <img src="" alt="">
    </a>
    @endforeach
  </div>
</div>
@endsection