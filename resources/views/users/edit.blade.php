@extends('layouts.main')
@section('title')
    Редактировать пользователя
@endsection

@section('content')
    <div class="m-12">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <form method="post" action="{{ route('users.update', ['user' => $user]) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">{{ __('Имя пользователя') }}</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            </div>

            <div class="form-group">
                <label for="email">{{ __('E-mail пользователя') }}</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
            </div>

            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
