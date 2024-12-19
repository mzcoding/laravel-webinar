@extends('layouts.main')
@section('title')
    Редактировать цель
@endsection

@section('content')
    <div class="m-12">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <form method="post" action="{{ route('goals.update', ['goal' => $goal]) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="project">{{ __('Проект') }}</label>
                <select class="form-control" id="project" name="project_id">
                    @foreach($projects as $project)
                        <option @if($project->id === $goal->project_id) selected @endif value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">{{ __('Наименование') }}</label>
                <input type="text" id="name" class="form-control" required name="name" value="{{ $goal->name }}">
            </div>

            <div class="form-group">
                <label for="term">{{ __('Срок в месяцах') }}</label>
                <input type="number" id="term" class="form-control" name="term_in_months" value="{{ $goal->term_in_months }}">
            </div>


            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
