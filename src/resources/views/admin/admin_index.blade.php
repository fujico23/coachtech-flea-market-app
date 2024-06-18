@extends('layouts.app')

@section('main')
<a class="return-link" href="#" onclick="history.back()">&lsaquo;</a>
<div class="main admin-index__container container-mg-200">
  <h1 class="admin-header header">Admin</h1>
  @include('components.session')
  <form action="{{ route('admin.destroy.users') }}" method="post" onsubmit="return confirm('本当に削除変更しますか？');">
    @csrf
    @method('delete')
    <button class="admin-index__container-delete-button btn--bg-pink" type="submit">削除</button>
    <table class="admin-index__container__table admin-table">
      <tr class="admin-index__container__table-row admin-table-row">
        <th class="admin-index__container__table-row__header admin-table-header">ID</th>
        <th class="admin-index__container__table-row__header admin-table-header">名前</th>
        <th class="admin-index__container__table-row__header admin-table-header">役割</th>
        <th class="admin-index__container__table-row__header admin-table-header"></th>
        <th class="admin-index__container__table-row__header admin-table-header"></th>
      </tr>
      @foreach ($users as $user)
      <tr class="admin-index__container__table-row admin-table-row">
        <td class="admin-index__container__table-row__description admin-table-description">{{ $user->id }}</td>
        <td class="admin-index__container__table-row__description admin-table-description">{{ $user->name ?? 'No Profile' }}</td>
        <td class="admin-index__container__table-row__description admin-table-description">
          @if($user->role->id == 1) 管理人
          @else 利用者
          @endif</td>
        <td class="admin-index__container__table-row__description admin-table-description">
          <a class="blue-link" href="{{ route('admin.show', $user) }}">詳細</a>
        </td>
        <td class="admin-index__container__table-row__description admin-table-description">
          <input type="checkbox" name="users[]" value="{{ $user->id }}">
        </td>
      </tr>
      @endforeach
    </table>
  </form>
</div>
@endsection