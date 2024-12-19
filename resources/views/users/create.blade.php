@extends('layouts.main')
@section('title')
    Добавить пользователя
@endsection

@section('content')
    <div class="m-12">
    <form method="post" action="{{ route('users.store') }}">
        @csrf
        <div class="form-group">
           <label for="name">{{ __('Имя пользователя') }}</label>
           <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
            <label for="email">{{ __('E-mail пользователя') }}</label>
            <input type="email" class="form-control" name="email">
        </div>

        <div class="form-group">
            <label for="password">{{ __('Пароль пользователя') }}</label>
            <input type="password" class="form-control" name="password">
        </div>
        <br>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>
    </div>
@endsection
