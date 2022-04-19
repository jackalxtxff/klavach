@extends('user.templates.template')
@section('title', 'Создание словаря')

@section('content')
    <section class="main mt-4">
        <div class="container">
            <h1>Cоздание словаря</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card px-3 py-4">
                        <div class="card-body">
                            <form action="{{route('dictionaries.store')}}" class="row g-3 form-dictionary create" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Название</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title" autocomplete="off">
                                        <div class="form-text">До 70 символов. Например: Слова на указательные пальцы</div>
                                        <div class="invalid-feedback" for="title">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="description" class="col-sm-2 col-form-label">Описание</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="description" name="description" autocomplete="off">
                                        <div class="form-text">Краткое описание словаря, до 300 символов. Например: Слова и слоги из букв для указательных пальцев</div>
                                        <div class="invalid-feedback" for="description">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="long_description" class="col-sm-2 col-form-label">Информация</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="information"
                                               name="information" autocomplete="off">
                                        <div class="form-text">Длинное описание словаря. Отображается на страничке словаря</div>
                                        <div class="invalid-feedback" for="information">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="is_publish" class="col-sm-2 col-form-label">Публичный</label>
                                    <div class="col-sm-10">
                                        <select id="is_publish" name="is_publish" class="form-select"
                                                aria-label="Default select example" style="width: 80px">
                                            <option selected value="1">Да</option>
                                            <option value="0">Нет</option>
                                        </select>
                                        <div class="form-text">Публичные словари могут использовать и комментировать другие пользователи</div>
                                    </div>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="is_publish" class="col-sm-2 col-form-label">Язык</label>
                                    <div class="col-sm-10">
                                        <select id="language" name="language" class="form-select"
                                                aria-label="Default select example" style="width: 115px">
                                            @foreach($languages as $language)
                                                <option value="{{$language['id']}}">{{$language['language']}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Язык раскладки используемый словарем</div>
                                    </div>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Тип словаря</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input type-dict" type="radio" name="type" id="words" value="1" checked>
                                            <label class="form-check-label" for="words">
                                                Слова
                                            </label>
                                            <div class="form-text">Текст для игры будет составляться из слов введенного вами текста, перемешанных в случайном порядке</div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input type-dict" type="radio" name="type" value="2" id="phrases">
                                            <label class="form-check-label" for="phrases">
                                                Фразы
                                            </label>
                                            <div class="form-text">В этом режиме перемешиваться будут не слова, а целые фразы, разделенные переносом строки</div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input type-dict" type="radio" name="type" value="3" id="texts">
                                            <label class="form-check-label" for="texts">
                                                Тексты
                                            </label>
                                            <div class="form-text">Цельные тексты, разделяемые пустой строкой</div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input type-dict" type="radio" name="type" value="4" id="book">
                                            <label class="form-check-label" for="book">
                                                Книга
                                            </label>
                                            <div class="form-text">Загрузка своего файла. Отрывки из файла будут браться в последовательном порядке</div>
                                        </div>
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="content" class="col-sm-2 col-form-label">Содержание</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="text" name="text" placeholder=""></textarea>
                                        <div class="form-text textarea-subtitle content-standard">Содержимое словаря</div>
                                        <div class="form-text textarea-subtitle content-words d-none">
                                            Список слов, из которых будет составляться текст. Допускаются русские и латинские символы, знаки препинания. Слова разделяются пробелом. Минимум 3 слова.<br>
                                            Пример: <b>про кот стол тип поток</b>
                                        </div>
                                        <div class="form-text textarea-subtitle content-phrases d-none">
                                            Список фраз и словосочетаний, каждая фраза в отдельной строке. Допускаются русские и латинские символы, знаки препинания. Минимум 3 строки.<br>
                                            Пример:<br>
                                            <b>Кукушка кукушонку купила капюшон. Надел кукушонок капюшон. Как в капюшоне он смешон.</b><br>
                                            <b>На дворе трава на траве дрова, не руби дрова на траве двора.</b><br>
                                            <b>Тридцать три корабля лавировали, лавировали, да не вылавировали.</b>
                                        </div>
                                        <div class="form-text textarea-subtitle content-texts d-none">
                                            Тексты отделяются пустой строкой. Переводы строк внутри текста разрешаются. Длина каждого текста не менее 100 символов. Допускаются русские и латинские символы, знаки препинания.
                                        </div>
                                        <div class="invalid-feedback" for="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
