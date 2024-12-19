@extends('layouts.main')
@section('title')
    Добавить шаг
@endsection

@section('content')
    <div class="m-12">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <form method="post" action="{{ route('steps.store') }}">
            @csrf
            <input type="hidden" name="goal_id" value="{{ request()->query('goal_id') }}">

            <div class="form-group">
                <label for="name">{{ __('Наименование') }}</label>
                <input type="text" id="name" class="form-control" required name="name">
            </div>

            <div class="form-group">
                <label for="started_at">{{ __('Дата начала') }}</label>
                <input type="date" id="started_at" class="form-control" name="started_at">
            </div>

            <div class="form-group">
                <label for="finished_at">{{ __('Дата окончания') }}</label>
                <input type="date" id="finished_at" class="form-control" name="finished_at">
            </div>

            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection

