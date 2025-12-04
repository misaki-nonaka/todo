@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/categories.css') }}">
@endsection

@section('content')
<div class="message">
    @if(session('message'))
    <div class="message__success">
        {{ session('message') }}
    </div>
    @endif
    @error('name')
    <div class="message__error">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @enderror
</div>
<div class="category__content">
    <form action="/categories" method="post" class="create-form">
        @csrf
        <div class="create-form__item">
            <input type="text" name="name" value="{{ old('name') }}" />
        </div>
        <div class="create-form__button">
            <button type="submit">作成</button>
        </div>
    </form>

    <div class="category-table">
        <table class="category-table__inner">
            <tr class="category-table__row">
                <th class="category-table__header">Todo</th>
            </tr>
            @foreach($categories as $category)
            <tr class="category-table__row">
                <td class=category-table__item>
                    <form action="/categories/update" method="post" class="update-form">
                        @method('PATCH')
                        @csrf
                        <div class="update-form__item">
                            <input type="text" name="name" value="{{ $category['name'] }}" class="update-form__item-input" />
                            <input type="hidden" name="id" value="{{ $category['id'] }}">
                        </div>
                        <div class="update-form__button">
                            <button type="submit" class="update-form__button-submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="category-table__item">
                    <form action="/categories/delete" method="post" class="delete-form">
                        @method('DELETE')
                        @csrf
                        <div class="delete-form__button">
                            <input type="hidden" name="id" value="{{ $category['id'] }}">
                            <button type="submit" class="delete-form__button-submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection