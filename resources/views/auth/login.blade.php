@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ __('Войдите ниже') }}</h1>
                            </div>
                            <form class="user" method="post" action="{{ route('login.store') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user"
                                           id="email" aria-describedby="email" name="email"
                                           placeholder="{{ __('Введите Email адрес...') }}">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                           name="password"
                                           id="password" placeholder="{{ __('Пароль') }}">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="remember">
                                        <label class="custom-control-label" for="remember">{{ __('Запомнить меня') }}</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Вход') }}
                                </button>
                                <hr>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-vimeo fa-fw"></i> {{ __('Вход через VK') }}
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('password.request') }}">{{ __('Забыли пароль?') }}</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('register') }}">{{ __('Создать аккаунт') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
