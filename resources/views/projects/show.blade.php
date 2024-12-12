@extends('layouts.app')
@section('title')
    Проект №{{ $project->id }} ({{$project->name}})
@endsection

@section('content')
    <div class="m12">
        <table class="table table-bordered">
            <tbody>
               <tr>
                   <td>Пользователь:</td>
                   <td><a href="">{{ $project->user->last_name }}, {{ $project->user->name }} ({{ $project->user->email }})</a></td>
               </tr>
               <tr>
                   <td>Наименование:</td>
                   <td>{{ $project->name }}</td>
               </tr>
               <tr>
                   <td>Описание:</td>
                   <td>{{ $project->description }}</td>
               </tr>
            </tbody>
        </table>
        <br>
        <h5>Список целей (<a href="{{ route('goals.create', ['project_id' => $project->id]) }}">Добавить цель</a>)</h5>
        <br>
        <table class="table table-bordered">
            <thead>
              <tr>
                  <th>Наименование цели</th>
                  <th>Срок в месяцах</th>
                  <th>Дата добавления</th>
                  <th>Управление</th>
              </tr>
            </thead>
            <tbody>
              @forelse($project->goals as $goal)
                  <tr>
                      <td>{{ $goal->name }}</td>
                      <td>{{ $goal->term_in_months }}</td>
                      <td>{{ $goal->created_at }}</td>
                      <td><a href="{{ route('goals.show', ['goal' => $goal]) }}" style="color: green;">Подробнее</a> &nbsp; <a href="">Редактировать</a> &nbsp; <a style="color:red;" href="">Удалить</a> </td>
                  </tr>
              @empty
                  <tr>
                      <td colspan="3">Записей не найдено</td>
                  </tr>
              @endforelse
            </tbody>
        </table>
    </div>
@endsection
