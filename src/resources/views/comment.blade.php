@extends('layouts.app')

@section('main')
<a class="return-link" href="#" onclick="history.back()">&lsaquo;</a>
<div class="main comment__container">
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
      <a href="{{ route('detail', $item) }}">{{ $item->name }}</a>
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
    <ul class="item__detail--comment">
      <h2>コメント一覧</h2>
      <div class="toggle">
        <div>
          @foreach ($comments as $comment)
          <li class="item__detail--comment__list">
            <form method="post" action="{{ route('comment.destroy', $comment) }}" onsubmit="return confirm('本当に削除変更しますか？');">
              @csrf
              @method('delete')
              @if ($comment->user->id === auth()->id())
              <div class="item__detail--comment__list--user item__detail--comment__list--user--right">
                <img class="profile__image comment__user-img" src="{{ $comment->user->icon_image ?? '' }}" alt="">
                <p>{{ $comment->user->name }}</p>
              </div>
              @else
              <div class="item__detail--comment__list--user left">
                <img class="profile__image comment__user-img" src="{{ $comment->user->icon_image ?? '' }}" alt="">
                <p>{{ $comment->user->name }}</p>
              </div>
              @endif
              <div class="item__detail--comment__list--text img-gray ">
                <p>{{ $comment->comment }}</p>
                <p>{{ $comment->created_at }}</p>
              </div>
              @if ($comment->user->id === auth()->id() )
              <div class="item__detail--comment__list--delete">
                <button class="" type="submit">コメント削除</button>
              </div>
              @endif
            </form>
          </li>
          @endforeach
        </div>
      </div>
    </ul>
    <div class="item__detail--comment__header">
      <h2 class="">商品のコメント </h2>
      <p class="error-message">@error('comment'){{ $message }}@enderror</p>
    </div>
    @if(Auth::check())
    <button class="blue-link" id="openAddCommentModal">Create a Default Comment!!</button>
    @endif
    @include('components.session')
    <select class="item__detail--default-comment" name="default_comment" id="default_comment">
      <option value="">コメントを選択する</option>
      @foreach($defaultComments as $defaultComment)
      <option value="{{ $defaultComment->comment }}">{{ $defaultComment->title }}</option>
      @endforeach
    </select>
    <div>
      <form action="{{ route('comment.store', $item) }}" method="post" class="item__detail--comment__form">
        @csrf
        <textarea class="item__detail--comment__form-textarea" name="comment" id="commentTextarea" textarea rows="4"></textarea>
        <button class="btn--bg-pink" type="submit">コメントを送信する</button>
      </form>
    </div>
  </div>
</div>

<!-- コメント追加用モーダルウィンドウ -->
<div id="addCommentModal" class="comment-modal">
  <div class="comment-modal-content">
    <span class="comment-modal-content-close" id="closeAddCommentModal">&times;</span>
    @include('comments.add_default_comment_form')
  </div>
</div>

<!-- コメント用モーダルウィンドウ -->
<script>
  var addCommentModal = document.getElementById("addCommentModal");
  var openAddCommentModalBtn = document.getElementById("openAddCommentModal");
  var closeAddCommentModalBtn = document.getElementById("closeAddCommentModal");

  openAddCommentModalBtn.onclick = function() {
    addCommentModal.style.display = "block";
    updateCommentModal.style.display = "none";
  }

  closeAddCommentModalBtn.onclick = function() {
    addCommentModal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == addCommentModal) {
      addCommentModal.style.display = "none";
    }
  }
</script>

<!-- コメント選択時の動作 -->
<script>
  document.getElementById('default_comment').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var commentTextarea = document.getElementById('commentTextarea');
    commentTextarea.value = selectedOption.value;
  });
</script>

<!-- 商品画像用 -->
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
            slide.style.display = "flex";
          } else {
            slide.style.display = "none";
          }
        });
      });
    });
  });
</script>

@endsection