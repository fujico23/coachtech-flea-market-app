@extends('layouts.app')

@section('main')
<a class="return-link" href="#" onclick="history.back()">&lsaquo;</a>
<div class="main detail__container">
  @if($item->itemImages->isNotEmpty())
  <div class="item__image">
    <div class="item__image__content">
      <div class="slider">
        @foreach ($item->ItemImages as $index => $itemImage)
        <div class="slide" id="slide-{{ $itemImage->id }}" style="{{ $index === 0 ? 'display: flex;' : 'display: none;' }}">
          <img src="{{ $itemImage->image_url }}" alt="" style="width: 100%; height: auto;">
        </div>
        @endforeach
      </div>
      <div class="slider__btn">
        <ul class="slider__btn__ul">
          @foreach ($item->ItemImages as $itemImage)
          <li class="slider__btn__ul-li">
            <a class="slider__btn__ul-li-link" data-id="slide-{{ $itemImage->id }}" href="#slide-{{ $itemImage->id }}">
              <img src="{{ $itemImage->image_url }}" alt="">
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  @else
  <div class="item__image img-gray">
    <div class="item__image__content">
      <img src="" alt="" width="100%" height="100%">
    </div>
  </div>
  @endif


  <div class="item__detail">
    <h1>
      <a href="">{{ $item->name }}</a>
    </h1>
    <p>{{ $item->brand->name }}</p>
    <p class="item__detail--price price">¥{{ $item->price }}（値段）</p>
    <div class="item__detail--icon icon">
      @if(!$item->isFavoriteByAuthUser())
      <form class="star" method="post" action="{{ route('favorite.add', $item) }}">
        @csrf
        <input type="image" src="{{ asset('img/star.svg') }}" alt="いいね" width="32px" height="32px">
        <p>{{ $item->favorites_count }}</p>
      </form>
      @else
      <form class="star" method="post" action="{{ route('favorite.destroy', $item) }}">
        @csrf
        @method('delete')
        <input type="image" src="{{ asset('img/star-yellow.svg') }}" alt="いいね" width="32px" height="32px">
        <p>{{ $item->favorites_count }}</p>
      </form>
      @endif
      <div class="comment">
        <a class="" href="{{ route('comment', $item) }}">
          <img src="{{ asset('img/comment.svg') }}" alt="logo" width="32px" height="32px">
        </a>
        <p>{{ $item->comments_count }}</p>
      </div>
    </div>
    @if($item->getOrderStatus(1))
    <a class="btn--bg-pink" href="{{ route('purchase', $item) }}">購入する</a>
    @elseif($item->getOrderStatus(2))
    <a class="btn--bg-pink disabled" href="{{ route('purchase', $item) }}">購入済み</a>
    @elseif($item->getOrderStatus(3))
    <a class="btn--bg-pink disabled" href="{{ route('purchase', $item) }}">購入済み</a>
    @else
    <a class="btn--bg-pink " href="{{ route('purchase', $item) }}">購入する</a>
    @endif
    <h2>商品説明</h2>
    <div class="item__detail--description">
      <p>カラー：{{ $item->color->name }}</p>
      <div class="item__detail--description--text">
        <span>{{ $item->description }}</span>
      </div>
    </div>
    <h2>商品の情報</h2>
    <div class="item__detail--info">
      <div class="item__detail--info--category">
        <h3>カテゴリー</h3>
        <p class="img-gray">{{ $item->category->parent->name }}</p>
        <p class="img-gray">{{ $item->category->name }}</p>
      </div>
      <div class="item__detail--info--condition">
        <h3>商品の状態</h3>
        <p>{{ $item->condition->name }}</p>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const links = document.querySelectorAll(".slider__btn__ul-li-link");
    const slides = document.querySelectorAll(".slide");

    // 最初に表示されるスライドを設定
    const initialSlide = document.querySelector(".slide");
    if (initialSlide) {
      initialSlide.style.display = "flex";
    }

    links.forEach(link => {
      link.addEventListener("click", function(event) {
        event.preventDefault();
        const targetId = this.getAttribute("data-id");

        slides.forEach(slide => {
          if (slide.id === targetId) {
            slide.style.display = "flex"; // 画像を表示
          } else {
            slide.style.display = "none"; // 他の画像を非表示
          }
        });
      });
    });
  });
</script>
@endsection