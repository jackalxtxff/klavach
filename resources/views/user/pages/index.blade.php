@extends('user.templates.template')

@section('title', 'Главная')

@section('content')
    <section class="main mt-4">
        <div class="container-lg">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1>Научись набирать текст на клавиатуре вслепую</h1>
                    <p class="fs-5">Klavach - эффективный тренажер для обучения слепой печати и для увеличения скорости набора текста на клавиатуре!
                        <br>Научись быстро печатать с клавиатурным тренажером Klavach.</p>
                    <a href="{{route('training.index')}}">
                        <button type="button" class="btn btn-lg btn-warning">Начать печатать</button>
                    </a>
                </div>
                <div class="col-6 d-none d-sm-none d-md-block"><img src="{{asset('img/keyboard.png')}}" class="img-fluid" alt=""></div>
            </div>
        </div>
        <div class="dark-section py-5 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0"><h4>Что такое слепая печать?</h4>
                                        <p class="fs-5">Набор текста вслепую, или набор текста всеми десятью пальцами, не глядя на
                                            клавиатуру,
                                            считается самым эффективным способом научиться печатать на клавиатуре. Научись быстро печатать с
                                            клавиатурным тренажером Klavach.</p>
                                        <a href="{{route('learn')}}">
                                            <button type="button" class="btn btn btn-warning">Обучение</button>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-6"><h4>Нужен ли мне аккаунт?</h4>
                                        <p class="fs-5">Создавать аккаунт не обязательно. Создав свой аккаунт ты сможешь сохранять статистику, иметь рейтинг, и создавать собственные словари.</p>
                                        <a href="{{route('login')}}">
                                            <button type="button" class="btn btn-outline-dark me-2">Вход</button>
                                        </a>
                                        <a href="{{route('register')}}">
                                            <button type="button" class="btn btn-warning">Регистрация</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
