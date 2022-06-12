@extends('user.templates.template')
@section('title', 'Вход')

@section('content')
    <section class="main mt-4">
        <div class="container-lg">
            <div class="row justify-content-center">
                <h1 class="text-center">Вход</h1>
                <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                    <div class="card p-3">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-gp mb-2">
                                    <label for="validationDefaultUsername" class="form-label">Электронная почта</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="fas fa-envelope"></i></span>
                                        <input id="email" type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               aria-describedby="inputGroupPrepend" placeholder="example@company.com"
                                               value="{{ old('email') }}" required autocomplete="email">
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
                                               required autocomplete="on">
                                        @error('password')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="remember"
                                               id="defaultCheck5" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="defaultCheck5">
                                            Запомнить меня
                                        </label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <div><a href="{{ route('password.request') }}" class="small text-right">Забыли пароль?</a></div>
                                    @endif
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-warning">Войти</button>
                                </div>
                            </form>
                            <div class="d-flex justify-content-center align-items-center mt-2">
                                <span class="fw-normal">
                                    Не зарегистрированы? <a href="{{ route('register') }}" class="fw-bold">Создайте аккаунт</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
