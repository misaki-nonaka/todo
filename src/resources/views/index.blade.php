@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="message">
    @if(session('message'))
    <div class="message__success">
        {{ session('message') }}
    </div>
    @endif
    @error('content')
    <div class="message__error">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @enderror
</div>
<div class="todo__content">
    <form action="/todos" method="post" class="create-form">
        @csrf
        <div class="create-form__item">
            <input type="text" name="content" />
        </div>
        <div class="create-form__button">
            <button type="submit">作成</button>
        </div>
    </form>

    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
            </tr>
            @foreach($todos as $todo)
            <tr class="todo-table__row">
                <td class=todo-table__item>
                    <form action="/todos/update" method="post" class="update-form">
                        @method('PATCH')
                        @csrf
                        <div class="update-form__item">
                            <input type="text" name="content" value="{{ $todo['content'] }}" class="update-form__item-input" />
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                        <div class="update-form__button">
                            <button type="submit" class="update-form__button-submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form action="/todos/delete" method="post" class="delete-form">
                        @method('DELETE')
                        @csrf
                        <div class="delete-form__button">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
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