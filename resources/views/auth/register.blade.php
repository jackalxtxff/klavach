ps
@extends('user.templates.template')
@section('title', 'Регистрация')

@section('content')
    <section class="main mt-4">
        <div class="container-lg">
            <div class="row justify-content-center">
                <h1 class="text-center">Регистрация</h1>
                <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                    <div class="card p-3">
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="input-gp mb-2">
                                    <label for="validationDefaultUsername" class="form-label">Никнейм</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="fas fa-user"></i></span>
                                        <input id="name" type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               aria-describedby="inputGroupPrepend" placeholder="Ваш никнейм"
                                               value="{{ old('name') }}" autocomplete="name" autofocus>
                                        @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-gp mb-2">
                                    <label for="validationDefaultUsername" class="form-label">Электронная почта</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="fas fa-envelope"></i></span>
                                        <input id="email" type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               aria-describedby="inputGroupPrepend" placeholder="example@company.com"
                                               value="{{ old('email') }}" autocomplete="email">
                                        @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-gp mb-2">
                                    <label for="validationDefaultUsername" class="form-label">Пароль</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="fas fa-lock"></i></span>
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" aria-describedby="inputGroupPrepend" placeholder="Пароль"
                                               autocomplete="new-password">
                                        @error('password')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-gp mb-3">
                                    <label for="validationDefaultUsername" class="form-label">Подтверждение
                                        пароля</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="fas fa-lock"></i></span>
                                        <input id="password-confirm" type="password" placeholder="Подтверждение пароля"
                                               class="form-control"
                                               name="password_confirmation" autocomplete="new-password">
                                        <div class="invalid-feedback">
                                            Please choose a username.
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-warning">Зарегистрироваться</button>
                                </div>
                            </form>
                            <div class="d-flex justify-content-center align-items-center mt-2">
                                <span class="fw-normal">
                                    Уже есть аккаун? <a href="{{ route('login') }}" class="fw-bold">Авторизируйся здесь</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
