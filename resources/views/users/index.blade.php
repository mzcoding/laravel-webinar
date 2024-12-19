@extends('layouts.main')
@section('title')
    Пользователи
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
          <th>#ID</th>
          <th>Имя</th>
          <th>E-mail</th>
          <th>Дата регистрации</th>
          <th>Управление</th>
        </thead>

        <tbody>
          @forelse($users as $user)
              <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }} {{ $user->last_name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at }}</td>
                  <td><a href="{{ route('users.edit', ['user' => $user->id]) }}">Редактировать</a>
                      &nbsp; <a href="javascript:;" class="delete" rel="{{ $user->id }}">Удаление</a></td>
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
                      if (confirm("Вы уверены что хотите удалить пользователя с #ID = " + id)) {
                          fetch(`/users/${id}`, {
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
