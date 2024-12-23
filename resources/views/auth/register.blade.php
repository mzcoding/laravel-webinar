@extends('layouts.app')
@section('content')

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
    <div class="col-lg-7">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ __('Создать кабинет') }}</h1>
            </div>
            <form class="user" method="post" action="{{ route('register.store') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="name"
                               name="name" required
                               placeholder="{{ __('Имя') }}">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="last_name"
                               name="last_name"
                               placeholder="{{ __('Фамилия') }}">
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="email"
                           name="email"
                           required
                           placeholder="{{ __('E-mail адрес') }}">
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user"
                               name="password" required
                               id="password" placeholder="{{ __('Пароль') }}">
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user"
                               name="password_confirmation"
                               id="password_confirmation" placeholder="{{ __('Повторите пароль') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Зарегистрироваться') }}
                </button>
                <hr>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                    <i class="fab fa-vimeo fa-fw"></i> {{ __('Регистрация через VK') }}
                </a>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{ route('login') }}">{{ __('Уже есть аккаунт? Войти') }}</a>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>

@endsection
