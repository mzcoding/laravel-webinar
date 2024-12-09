@extends('layouts.app')
@section('title')
    Проекты
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
          <th>#ID</th>
          <th>Пользователь</th>
          <th>Наименование</th>
          <th>Дата регистрации</th>
          <th>Управление</th>
        </thead>

        <tbody>
          @forelse($projects as $project)
              <tr>
                  <td>{{ $project->id }}</td>
                  <td>{{ $project->user_id }}</td>
                  <td>{{ $project->name }}</td>
                  <td>{{ $project->created_at }}</td>
                  <td><a href="{{ route('projects.edit', ['project' => $project->id]) }}">Редактировать</a>
                      &nbsp; <a href="javascript:;" class="delete" rel="{{ $project->id }}">Удаление</a></td>
              </tr>
          @empty
              <tr>
                  <td colspan="5"><h3>Записей не найдено</h3></td>
              </tr>
          @endforelse
        </tbody>
    </table>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
              const items = document.querySelectorAll('.delete');
              items.forEach(function (item) {
                  item.addEventListener('click', function () {
                      const id = this.getAttribute('rel');
                      if (confirm("Вы уверены что хотите удалить проект с #ID = " + id)) {
                          fetch(`/projects/${id}`, {
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
