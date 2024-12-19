@extends('layouts.main')
@section('title')
    Цель №{{ $goal->id }} ({{$goal->name}})
@endsection

@section('content')
    <div class="m12">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
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
        <h5>Список шагов (<a href="{{ route('steps.create', ['goal_id' => $goal->id]) }}">Добавить новый шаг</a>)</h5>
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
                    <td>{{ $step->started_at->format('d-m-Y') }}</td>
                    <td>{{ $step->finished_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('steps.edit', ['step' => $step]) }}">Редактировать</a> &nbsp;
                        <a rel="{{ $step->id }}" style="color:red;" class="delete" href="javascript:;">Удалить</a> </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Записей не найдено</td>
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
                    if (confirm("Вы уверены что хотите удалить шаг с #ID = " + id)) {
                        fetch(`/steps/${id}`, {
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
