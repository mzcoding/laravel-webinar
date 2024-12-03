@extends('layouts.app')
@section('title')
    {{ __('Пользователи') }}
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
          <th>#ID</th>
          <th>{{ __('Имя') }}</th>
          <th>E-mail</th>
          <th>{{ __('Дата регистрации') }}</th>
          <th>{{ __('Управление') }}</th>
        </thead>

        <tbody>
          @forelse($users as $user)
              <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at }}</td>
                  <td><a href="{{ route('users.edit', ['user' => $user->id, 'locale' => $locale]) }}">{{ __('Редактировать') }}</a>
                      &nbsp; <a href="javascript:;" class="delete" rel="{{ $user->id }}">{{ __('Удаление') }}</a></td>
              </tr>
          @empty
              <tr>
                  <td colspan="5"><h3>{{ __('Записей не найдено') }}</h3></td>
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
