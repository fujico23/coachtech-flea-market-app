@extends('layouts.app')

@section('main')
<div class="main sell-edit__container">
  <h1 class="sell-edit__container__header header">商品の出品</h1>
  @include('components.session')
  <form action="{{ route('sell.listing') }}" method="post" class="sell-edit__container--form form" enctype="multipart/form-data">
    @csrf
    <div class="sell-edit__container--form__inner form__inner">
      <div class="form__inner-group">
        <p>商品画像</p>
        <div class="sell-edit__container--form-tag form-input--style input-file">
          <input class="sell-edit__container--form-tag--file" type="file" name="image_url[]" multiple>
        </div>
        <p class="error-message">@error('image_url'){{ $message }}@enderror</p>
      </div>
      <h2 class="border-bottom-gray">商品の詳細</h2>
      <div class="form__inner-group">
        <p>カテゴリー</p>
        <div class="sell-edit__container--form-tag form-input--style">
          <select name="" id="parentCategory">
            <option value="">カテゴリーを選択する</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">
              {{ $category->name }}
            </option>
            @endforeach
          </select>
        </div>
        <p class="error-message">@error('category_id'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <div class="sell-edit__container--form-tag form-input--style category-hidden">
          <select id="childCategory">
            <option value="">Select Child Category</option>
          </select>
        </div>
      </div>
      <div class="form__inner-group">
        <div class="sell-edit__container--form-tag form-input--style category-hidden">
          <select name="category_id" id="grandchildCategory">
            <option value="{{ $category->id }}">Select Grandchild Category</option>
          </select>
        </div>
      </div>
      <div class="form__inner-group">
        <p>商品のブランド</p>
        <div class="sell-edit__container--form-tag form-input--style">
          <select name="brand_id" id="">
            <option value="">商品のブランドを選択してください</option>
            @foreach ($brands as $brand)
            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
              {{ $brand->name }}
            </option>
            @endforeach
          </select>
        </div>
        <p class="error-message">@error('brand_id'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <p>商品のカラー</p>
        <div class="sell-edit__container--form-tag form-input--style">
          <select name="color_id" id="">
            <option value="">商品のカラーを選択してください</option>
            @foreach ($colors as $color)
            <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>
              {{ $color->name }}
            </option>
            @endforeach
          </select>
        </div>
        <p class="error-message">@error('color_id'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <p>商品の状態</p>
        <div class="sell-edit__container--form-tag form-input--style">
          <select name="condition_id" id="">
            <option value="">商品の状態を選択してください</option>
            @foreach ($conditions as $condition)
            <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>
              {{ $condition->name }}
            </option>
            @endforeach
          </select>
        </div>
        <p class="error-message">@error('condition_id'){{ $message }}@enderror</p>
      </div>
      <h2 class="border-bottom-gray">商品名と説明</h2>
      <div class="form__inner-group">
        <p>商品名</p>
        <div class="sell-edit__container--form-tag form-input--style">
          <input type="text" name="name" value="{{ old('name') }}" placeholder="例：Laravelの教科書（中古）">
        </div>
        <p class="error-message">@error('name'){{ $message }}@enderror</p>
      </div>
      <div class="form__inner-group">
        <p>商品の説明</p>
        <div class="sell-edit__container--form-tag form-input--style">
          <textarea name="description" rows="4">{{ old('description') }}</textarea>
        </div>
        <p class="error-message">@error('description'){{ $message }}@enderror</p>
      </div>
      <h2 class="border-bottom-gray">販売価格</h2>
      <div class="form__inner-group">
        <p>販売価格</p>
        <div class="sell-edit__container--form-tag form-input--style">
          <input type="text" name="price" value="{{ old('price') }}" placeholder="1000">
        </div>
        <p class="error-message">@error('price'){{ $message }}@enderror</p>
      </div>
      <button class="btn--bg-pink" type="submit">更新する</button>
    </div>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    let parentSelect = document.getElementById('parentCategory');
    let childSelect = document.getElementById('childCategory');
    let grandchildSelect = document.getElementById('grandchildCategory');

    if (!parentSelect || !childSelect || !grandchildSelect) {
      console.log('Some elements are not found.');
      return;
    }
    // 親カテゴリ選択時のイベント
    parentSelect.addEventListener('change', function() {
      let parentId = parentSelect.value;
      let parentName = parentSelect.options[parentSelect.selectedIndex].text;
      if (parentId) {
        fetch(`/categories/${parentId}/subcategories`)
          .then(response => response.json())
          .then(data => {
            childSelect.innerHTML = `<option value="">${parentName}を選択してください</option>`;
            data.forEach(category => {
              let option = document.createElement('option');
              option.value = category.id;
              option.textContent = category.name;
              childSelect.appendChild(option);
            });
            childSelect.parentElement.classList.remove('category-hidden');
            grandchildSelect.innerHTML = '<option value="">Select Grandchild Category</option>'; // 孫セレクトをリセット
            grandchildSelect.parentElement.classList.add('category-hidden'); // 孫セレクトを非表示
          });
      } else {
        childSelect.innerHTML = '<option value="">Select Child Category</option>';
        childSelect.parentElement.classList.add('category-hidden');
        grandchildSelect.innerHTML = '<option value="">Select Grandchild Category</option>';
        grandchildSelect.parentElement.classList.add('category-hidden');
      }
    });

    // 子カテゴリ選択時のイベント
    childSelect.addEventListener('change', function() {
      let childId = childSelect.value;
      let childName = childSelect.options[childSelect.selectedIndex].text;
      if (childId) {
        fetch(`/categories/${childId}/subcategories`)
          .then(response => response.json())
          .then(data => {
            grandchildSelect.innerHTML = `<option value="">${childName}を選択してください</option>`;
            data.forEach(category => {
              let option = document.createElement('option');
              option.value = category.id;
              option.textContent = category.name;
              grandchildSelect.appendChild(option);
            });
            grandchildSelect.parentElement.classList.remove('category-hidden');
          });
      } else {
        grandchildSelect.innerHTML = '<option value="">Select Grandchild Category</option>';
        grandchildSelect.parentElement.classList.add('category-hidden');
      }
    });
  });
</script>
@endsection