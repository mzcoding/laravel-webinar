@extends('layouts.app')
@section('title')
    Цель №{{ $goal->id }} ({{$goal->name}})
@endsection

@section('content')
    <div class="m12">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>Проект:</td>
                <td><a href="{{ route('projects.show', ['project' => $goal->project->id]) }}">({{ $goal->project->name }})</a></td>
            </tr>
            <tr>
                <td>Наименование:</td>
                <td>{{ $goal->name }}</td>
            </tr>
            <tr>
                <td>Срок выполнения в месяцах:</td>
                <td>{{ $goal->term_in_months }}</td>
            </tr>
            </tbody>
        </table>
        <br>
        <h5>Список шагов (<a href="">Добавить новый шаг</a>)</h5>
        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Наименование шага</th>
                <th>Дата старта</th>
                <th>Дата окончания</th>
                <th>Управление</th>
            </tr>
            </thead>
            <tbody>
            @forelse($goal->steps as $step)
                <tr>
                    <td>{{ $step->name }}</td>
                    <td>{{ $step->started_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $step->finished_at->format('d-m-Y H:i') }}</td>
                    <td><a href="" style="color: green;">Подробнее</a> &nbsp; <a href="">Редактировать</a> &nbsp; <a style="color:red;" href="">Удалить</a> </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Записей не найдено</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
