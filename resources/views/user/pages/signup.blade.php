@extends('user.templates.template')

@section('title', 'Регистрация')

@section('content')
    <section class="main mt-4">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="text-center">Регистрация</h1>
                <div class="col-12 col-md-5">
                    <div class="card p-3">
                        <div class="card-body">
                            <div class="input-gp mb-2">
                                <label for="validationDefaultUsername" class="form-label">Имя</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="validationCustomUsername"
                                           aria-describedby="inputGroupPrepend" placeholder="Ваше имя" required="">
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>
                            <div class="input-gp mb-2">
                                <label for="validationDefaultUsername" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-envelope"></i></span>
                                    <input type="text" class="form-control" id="validationCustomUsername"
                                           aria-describedby="inputGroupPrepend" placeholder="example@company.com" required="">
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>
                            <div class="input-gp mb-2">
                                <label for="validationDefaultUsername" class="form-label">Пароль</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-lock"></i></span>
                                    <input type="text" class="form-control" id="validationCustomUsername"
                                           aria-describedby="inputGroupPrepend" placeholder="Пароль" required="">
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>
                            <div class="input-gp mb-3">
                                <label for="validationDefaultUsername" class="form-label">Подтверждение пароля</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-lock"></i></span>
                                    <input type="text" class="form-control" id="validationCustomUsername"
                                           aria-describedby="inputGroupPrepend" placeholder="Подтверждение пароля" required="">
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="button" class="btn btn-warning">Зарегистрироваться</button>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-2">
                                <span class="fw-normal">
                                    Уже есть аккаун? <a href="./sign-in.html" class="fw-bold">Авторизируйся здесь</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
