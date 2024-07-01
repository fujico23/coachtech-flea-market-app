<div class="main verification__container">
  <h1 class="verification__container__header header">カスタマイズコメントを追加</h1>
  <div class="verification__container__inner">
    <form action="{{ route('defaultComment.add') }}" method="post">
      @csrf
      <div>
        <p>Title</p>
        <input class="form-input--style" type="text" name="title" id="title" required>
      </div>
      <div>
        <label for="comment">Comment</label>
        <textarea name="comment" id="comment" required></textarea>
      </div>
      <div class="verification__container__btn-group">
        <button class="btn--border-pink--small" type="submit">追加</button>
      </div>
    </form>
  </div>
  @php
  $userSpecificComments = $defaultComments->filter(function($comment) {
  return $comment->user_id === Auth::id();
  });
  @endphp
  <h1 class="verification__container__header header">カスタマイズコメントを更新</h1>
  @foreach($userSpecificComments as $defaultComment)
  <div class="verification__container__inner">
    <h3>{{ $defaultComment->title }} の更新</h3>
    <form action="{{ route('defaultComment.update', $defaultComment) }}" method="post">
      @csrf
      <div>
        <p>Title</p>
        <input class="form-input--style" type="text" name="title" id="title_{{ $defaultComment->id }}" value="{{ $defaultComment->title }}" required>
      </div>
      <div>
        <label for="comment_{{ $defaultComment->id }}">Comment</label>
        <textarea name="comment" id="comment_{{ $defaultComment->id }}" required>{{ $defaultComment->comment }}</textarea>
      </div>
      <div class="verification__container__btn-group">
        <button class="btn--border-pink--small" type="submit">更新</button>
      </div>
    </form>
  </div>
  @endforeach