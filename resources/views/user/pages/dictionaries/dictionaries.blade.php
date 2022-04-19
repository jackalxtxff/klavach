@extends('user.templates.template')

@section('title', 'Словари')

@section('content')
    <section class="main mt-4">
        <div class="container">
            <div class="row dictionaries-section" data-uri="{{route('dictionaries.index')}}">
                <div class="col-12 col-md-3">
                    <div class="card p-3 category-container">
                        <div class="card-body">
                            <div class="d-grid mb-2">
                                <a href="{{route('dictionaries.create')}}">
                                    <button type="button" class="btn btn-outline-dark me-2">Создать словарь</button>
                                </a>
                            </div>
                            <div class="list-group mx-0 mb-2">
                                <h4>Раздел</h4>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="chapter"
                                           id="listGroupSection1" data-value="all"
                                           data-uri="{{route('dictionaries.index')}}" value="" checked="">
                                    <span>
                                        Любые
                                    </span>
                                </label>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="chapter"
                                           id="listGroupSection2" data-value="my"
                                           data-uri="{{route('dictionaries.index')}}" @if(request()->has('chapter') && request()->chapter == "my") checked @endif>
                                    <span>
                                        Созданные мной
                                    </span>
                                </label>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="chapter"
                                           id="listGroupSection3" data-value="favs"
                                           data-uri="{{route('dictionaries.index')}}" @if(request()->has('chapter') && request()->chapter == "favs") checked @endif>
                                    <span>
                                        Используемые мной
                                    </span>
                                </label>
                            </div>
                            <div class="list-group mx-0 mb-2">
                                <h4>Тип</h4>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="type-sort"
                                           id="listGroupType1" data-value="0" data-uri="{{route('dictionaries.index')}}"
                                           checked="">
                                    <span>
                                        Любые
                                    </span>
                                </label>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="type-sort"
                                           id="listGroupType2" data-value="1"
                                           data-uri="{{route('dictionaries.index')}}" @if(request()->has('type') && request()->type == 1) checked @endif>
                                    <span>
                                        Слова
                                    </span>
                                </label>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="type-sort"
                                           id="listGroupType3" data-value="2"
                                           data-uri="{{route('dictionaries.index')}}" @if(request()->has('type') && request()->type == 2) checked @endif>
                                    <span>
                                        Фразы
                                    </span>
                                </label>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="type-sort"
                                           id="listGroupType4" data-value="3"
                                           data-uri="{{route('dictionaries.index')}}" @if(request()->has('type') && request()->type == 3) checked @endif>
                                    <span>
                                        Тексты
                                    </span>
                                </label>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="type-sort"
                                           id="listGroupType5" data-value="4"
                                           data-uri="{{route('dictionaries.index')}}" @if(request()->has('type') && request()->type == 4) checked @endif>
                                    <span>
                                        Книги
                                    </span>
                                </label>
                            </div>
                            <div class="list-group mx-0">
                                <h4>Сортировка</h4>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="sort"
                                           id="listGroupSorting1" data-value="popular" checked="">
                                    <span>
                                        По популярности
                                    </span>
                                </label>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="sort"
                                           id="listGroupSorting2" data-value="grade"
                                           data-uri="{{route('dictionaries.index')}}" @if(request()->has('sort') && request()->sort == 'grade') checked @endif>
                                    <span>
                                        По оценкам
                                    </span>
                                </label>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="sort"
                                           id="listGroupSorting3" data-value="diff"
                                           data-uri="{{route('dictionaries.index')}}" @if(request()->has('sort') && request()->sort == 'diff') checked @endif>
                                    <span>
                                        По сложности
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <h1>Словари</h1>
                    <div class="card p-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="input-group mb-3 me-2">
                                    <input type="search" class="form-control" placeholder="Поиск по словарям"
                                           aria-label="Search" name="search" data-uri="{{route('dictionaries.index')}}"
                                           value="@if(request()->has('search')){{request()->search}}@endif">
                                    <button type="submit" class="btn btn-secondary search-btn"
                                            data-uri="{{route('dictionaries.index')}}">Найти
                                    </button>
                                </div>
                                <div>
                                    <input type="checkbox" class="btn-check" id="direction" name="direction" autocomplete="off"
                                           @if(request()->has('direction') && request()->direction == 'asc') checked @endif>
                                    <label class="btn btn-outline-dark" for="direction"><i
                                            class="fa-solid @if(request()->has('direction') && request()->direction == 'asc') fa-arrow-up @else fa-arrow-down @endif"></i></label>
                                </div>
                            </div>
                            <div class="dictionaries-container">
                                @include('user.pages.dictionaries.ajax.dictionariesSorting')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
