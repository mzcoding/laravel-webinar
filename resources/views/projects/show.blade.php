@extends('layouts.main')
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
               @if ($project->image)
               <tr>
                   <td colspan="2"><img src="{{ Storage::disk('public')->url($project->image) }}" /> </td>
               </tr>
               @endif
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
                      <td><a href="{{ route('goals.show', ['goal' => $goal]) }}" style="color: green;">Подробнее</a> &nbsp; <a href="{{ route('goals.edit', ['goal' => $goal]) }}">Редактировать</a> &nbsp;
                          <a rel="{{ $goal->id }}" style="color:red;" class="delete" href="javascript:;">Удалить</a> </td>
                  </tr>
              @empty
                  <tr>
                      <td colspan="3">Записей не найдено</td>
                  </tr>
              @endforelse
            </tbody>
        </table>
    </div>


    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            const items = document.querySelectorAll('.delete');
            items.forEach(function (item) {
                item.addEventListener('click', function () {
                    const id = this.getAttribute('rel');
                    if (confirm("Вы уверены что хотите удалить цель с #ID = " + id)) {
                        fetch(`/goals/${id}`, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute('content')
                            }
                        }).then(response => {
                            location.reload();
                        });
                    } else {
                        alert('Удаление отменено');
                    }
                });
            });
        });
    </script>
@endsection
