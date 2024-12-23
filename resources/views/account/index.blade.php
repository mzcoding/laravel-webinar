<div>
    <p><strong>Привет, {{ auth()->user()->name }}</strong></p>
    <p>
        <form method="post" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Выход</button>
        </form>
    </p>
    <br>
    <a href="{{ route('users.index') }}">В админку</a>
</div>
