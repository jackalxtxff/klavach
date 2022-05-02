@extends('user.templates.template')

@section('title', 'Обучение')

@section('content')
    <section class="main mt-4">
        <div class="container">
            <h1>Обучение</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card px-lg-2">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-8">
                                    <h2 class="text-center">Узнай, как печатать вслепую</h2>
                                    <p class="fs-5">Главная идея слепой печати в том, что за каждым пальцем закреплена
                                        своя зона клавиш. Это позволяет печатать не глядя на клавиатуру. Регулярно
                                        тренируйся и, благодаря мышечной памяти, все твои десять пальцем будут знать,
                                        куда нажать.</p>
                                </div>
                            </div>
                            <hr class="divider">
                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-11 col-xxl-10">
                                    <div class="row">
                                        <div class="col-12 col-lg-3 order-1 order-lg-1">
                                            <h4>Поза при печати текста</h4>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-6 order-3 order-md-2 order-lg-2">
                                            <ul class="fs-6">
                                                <li>Сиди ровно и держи спину прямой.</li>
                                                <li>Локти держи согнутыми под прямым углом.</li>
                                                <li>Голова должна быть немного наклонена вперед.</li>
                                                <li>Расстояние от глаз до экрана должно быть 45-70 см.</li>
                                                <li>Расслабь мышцы плеч, рук и кистей. Кисти могут немного касаться
                                                    стола в
                                                    нижней части клавиатуры, но не переноси
                                                    вес тела на руки, чтобы не перенапрягать кисти.
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 order-2 order-md-3 order-lg-3 text-center">
                                            <img class="d-inline" src="{{asset('img/ru.png')}}" alt="" width="180"
                                                 height="216">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="divider">
                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-11 col-xxl-10">
                                    <div class="row">
                                        <div class="col-12 col-lg-3 ">
                                            <h4>Исходная позиция</h4>
                                        </div>
                                        <div class="col-12 col-lg-9 text-center">
                                            <img class="d-inline img-fluid" src="{{asset('img/main_keys.png')}}" alt=""
                                                 width="420"
                                                 height="120">
                                        </div>
                                        <div class="col-12 col-lg-9 offset-lg-3">
                                            <p>Немного согни пальцы и положи их на клавиши ФЫВА и ОЛДЖ, которые
                                                находятся в
                                                среднем ряду. Эта строка называется ОСНОВНОЙ СТРОКОЙ, потому что ты
                                                всегда
                                                будешь начинать с этих клавиш и возвращаться к ним.</p>
                                            <p>На клавишах А и О, под указательными пальцами, находятся небольшие
                                                выступы.
                                                Они позволяют ориентироваться на клавиатуре вслепую.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="divider">
                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-11 col-xxl-10">
                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <h4>Скорость печати</h4>
                                        </div>
                                        <div class="col-12 col-lg-9 text-center">
                                            <img class="d-inline img-fluid" src="{{asset('img/keyboard2.png')}}" alt=""
                                                 width="600"
                                                 height="260">
                                        </div>
                                        <div class="col-12 col-lg-9 offset-lg-3">
                                            <p>Цвет клавиш на этой клавиатуре поможет тебе понять и запомнить, каким
                                                пальцем на какую клавишу нужно нажимать.</p>
                                            <ul>
                                                <li>Нажимай клавиши только тем пальцем, который для них предназначен.
                                                </li>
                                                <li>Всегда возвращай пальцы в исходную позицию «ФЫВА – ОЛДЖ».</li>
                                                <li>Когда набираешь текст, представляй расположение клавиш.</li>
                                                <li>Установи ритм и соблюдай его, пока печатаешь. Нажимай на клавиши с
                                                    одинаковым интервалом.
                                                </li>
                                                <li>Клавишу SHIFT всегда нажимает мизинец с противоположной стороны от
                                                    нужной буквы.
                                                </li>
                                                <li>Пробел отбивай большим пальцем левой или правой руки, как тебе
                                                    удобнее.
                                                </li>
                                            </ul>
                                            <p>Сначала такой метод печати может показаться неудобным. Но не
                                                останавливайся. Со временем все будет получаться быстро, легко и удобно.
                                                Чтобы добиться максимального результата, выбирай курс слепой печати для
                                                твоей раскладки клавиатуры и на нужном языке.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="divider">
                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-11 col-xxl-10">
                                    <div class="row">
                                        <div class="col-12 col-lg-3 order-1 order-lg-1">
                                            <h4>Движение пальцев</h4>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-6 order-3 order-md-2 order-lg-2">
                                            <p>Не подглядывай на клавиатуру во время печати. Просто скользи пальцами по
                                                клавишам, пока не найдешь основную строку.</p>
                                            <p>Ограничь движение кистей и пальцев до минимума, только чтобы нажимать
                                                нужные клавиши. Держи руки и пальцы как можно ближе к исходной позиции.
                                                Это увеличит скорость набора текста и снизит нагрузку на кисти.</p>
                                            <p>Следи за безымянными пальцами и мизинцами, так как они часто остаются
                                                незадействованными.</p>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 order-2 order-md-3 order-lg-3 text-center">
                                            <img class="d-inline" src="{{asset('img/man.png')}}" alt="" width="150"
                                                 height="230">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="divider">
                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-11 col-xxl-10">
                                    <div class="row">
                                        <div class="col-12 col-lg-3 ">
                                            <h4>Скорость печати</h4>
                                        </div>
                                        <div class="col-12 col-lg-9">
                                            <ul>
                                                <li>Не пытайся сразу печатать со скоростью света. Начинай ускоряться,
                                                    только когда все 10 пальцев привыкнут нажимать правильные клавиши.
                                                </li>
                                                <li>Не торопись когда печатаешь, чтобы избежать ошибок. Скорость будет
                                                    возрастать постепенно.
                                                </li>
                                                <li>Всегда просматривай текст на одно-два слова вперед.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="divider">
                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-11 col-xxl-10">
                                    <div class="row">
                                        <div class="col-12 col-lg-3 ">
                                            <h4>Береги себя</h4>
                                        </div>
                                        <div class="col-12 col-lg-9">
                                            <p>Сделай паузу, если чувствуешь, что сбиваешься и делаешь много ошибок.
                                                Небольшой перерыв вернет силы и внимательность.</p>
                                        </div>
                                        <div class="col-12 text-center">
                                            <a href="{{route('training.index')}}">
                                                <button type="button" class="btn btn-lg btn-warning d-inline">Начать
                                                    печатать
                                                </button>
                                            </a>
                                        </div>
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
