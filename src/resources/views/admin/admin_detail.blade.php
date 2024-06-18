@extends('layouts/app')

@section('main')
<a class="return-link" href="#" onclick="history.back()">&lsaquo;</a>
<div class="main admin-index__container">
  <h1 class="admin-header header">ユーザー詳細</h1>
  @include('components.session')
  <a class="admin-detail__container__mail-link btn--bg-pink" href="{{ route('mail.create', $user) }}">個人メールフォーム</a>
  <table class="admin-detail__container__table admin-table">
    <tr class="admin-detail__container__table-row admin-table-row">
      <th class="admin-detail__container__table-row__header admin-table-header">ID</th>
      <td class="admin-detail__container__table-row__description admin-table-description">{{ $user->id }}</td>
    </tr>
    <tr class="admin-detail__container__table-row admin-table-row">
      <th class="admin-detail__container__table-row__header admin-table-header">名前</th>
      <td class="admin-detail__container__table-row__description admin-table-description">{{ $user->name ?? '未登録' }}</td>
    </tr>
    <tr class="admin-detail__container__table-row admin-table-row">
      <th class="admin-detail__container__table-row__header admin-table-header">会員登録日</th>
      <td class="admin-detail__container__table-row__description admin-table-description">{{ $user->created_at }}</td>
    </tr>
    <tr class="admin-detail__container__table-row admin-table-row">
      <th class="admin-detail__container__table-row__header admin-table-header">Email</th>
      <td class="admin-detail__container__table-row__description admin-table-description">{{ $user->email }}</td>
    </tr>
    <tr class="admin-detail__container__table-row admin-table-row">
      <th class="admin-detail__container__table-row__header admin-table-header">自宅住所</th>
      <td class="admin-detail__container__table-row__description admin-table-description">
        {{ $homeAddress->postal_code ?? '' }}
        <br>
        {{ $homeAddress->address ?? '未登録' }}
        <br>
        {{ $homeAddress->building_name ?? '' }}
      </td>
    </tr>
    @if (!$shippingAddresses->isEmpty())
    <tr class="admin-detail__container__table-row admin-table-row">
      <th class="admin-detail__container__table-row__header admin-table-header">配送先一覧</th>
      <td class="admin-detail__container__table-row__description admin-table-description">
        <select class="admin-detail__container__table-row__description-select form-input--style" name="shipping_address" id="shipping_address_select">
          <option value="">配送先詳細を選択</option>
          @foreach ($shippingAddresses as $shippingAddress)
          <option value="{{ $shippingAddress->plain_address }}" data-full-address="{{ $shippingAddress->full_address }}">
            {{ $shippingAddress->plain_address ?? '未登録' }}
          </option>
          @endforeach
        </select>
      </td>
    </tr>
    <tr class="admin-detail__container__table-row admin-table-row">
      <th class="admin-detail__container__table-row__header admin-table-header">配送先表示</th>
      <td class="admin-detail__container__table-row__description admin-table-description" id="shipping_address_display">
        No Select
      </td>
    </tr>
    @endif
    <tr class="admin-detail__container__table-row admin-table-row">
      <th class="admin-detail__container__table-row__header admin-table-header">役割</th>
      <td class="admin-detail__container__table-row__description admin-table-description">
        <form class="admin-detail__container__table-row__form-patch" action="{{ route('role.update', ['user' => $user->id]) }}" method="POST" onsubmit="return confirm('本当に変更しますか？');">
          @csrf
          @method('patch')
          <select class="admin-detail__container__table-row__description-select form-input--style" name="role_id">
            <option value="">
              @if($user->role_id == 1 )管理者
              @else($user->role_id == 2 )利用者
              @endif
            </option>
            @foreach ($roles as $role)
            <option class="admin-detail__container__table-role-option" value="{{ $role->id }}">
              @if($role->id == 1) 管理者
              @else 利用者
              @endif
            </option>
            @endforeach
          </select>
          <button class="admin-detail__container__table__btn-patch btn--border-pink--small" type="submit">変更</button>
        </form>
      </td>
    </tr>
    <tr class="admin-detail__container__table-row admin-table-row">
      <th class="admin-detail__container__table-row__header admin-table-header">コメント一覧</th>
      <td class="admin-detail__container__table-row__description admin-table-description">
        <ul class="admin-table-comment-description">
          @foreach ($comments as $comment)
          <li class="admin-table-comment-description__li">
            <form action=" {{ route('comment.destroy', $comment) }}" method="post" onsubmit="return confirm('本当に削除変更しますか？');">
              @csrf
              @method('delete')
              <p class="admin-table-comment-description__li-created">【{{ $comment->created_at }} 】<button class="btn--border-pink--small" type="submit">削除</button></p>
              <p class="admin-table-comment-description__li-item"><a class="blue-link" href="{{ route('comment', $comment->item->id) }}">{{ $comment->item->name }}</a></p>
              <p class="admin-table-comment-description__li-comment"> {{ $comment->comment }} </p>
            </form>
          </li>
          @endforeach
        </ul>
        {{ $comments->links('vendor.pagination.pagination') }}
      </td>
    </tr>
  </table>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const selectShippingAddressElement = document.getElementById('shipping_address_select');
    const shippingAddressElement = document.getElementById('shipping_address_display');
    selectShippingAddressElement.addEventListener('change', function() {
      const selectedOption = selectShippingAddressElement.options[selectShippingAddressElement.selectedIndex];
      const fullAddress = selectedOption.getAttribute('data-full-address');
      shippingAddressElement.innerHTML = fullAddress || '選択してください';
    });
  });
</script>

@endsection