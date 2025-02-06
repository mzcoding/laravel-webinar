@extends('layouts.main')
@section('title')
    Редактировать проект
@endsection

@section('content')
    <div class="m-12">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <form method="post" action="{{ route('projects.update', ['project' => $project]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="user">{{ __('Пользователь') }}</label>
                <select class="form-control" id="user" name="user_id">
                    @foreach($users as $user)
                        <option @if($project->user_id === $user->id) selected @endif value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">{{ __('Наименование') }}</label>
                <input type="text" id="name" class="form-control" required name="name" value="{{ $project->name }}">
            </div>

            <div class="form-group">
                <label for="image">{{ __('Изображение') }}</label>
                <input type="file" id="image" class="form-control" name="image">
            </div>

            <div class="form-group">
                <label for="description">{{ __('Описание') }}</label>
                <textarea class="form-control" name="description" id="description">{!! $project->description !!}</textarea>
            </div>

            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
