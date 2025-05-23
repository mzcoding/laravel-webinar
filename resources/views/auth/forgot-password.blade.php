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
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Сбросить пароль') }}</h1>
                                </div>
                                <form class="user" method="post" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                               id="email" aria-describedby="email" name="email"
                                               placeholder="{{ __('Введите Email адрес...') }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Сбросить пароль') }}
                                    </button>

                                </form>
                                <hr>
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
