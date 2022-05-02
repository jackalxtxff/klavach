@extends('admin.templates.template')

@section('title', 'Словари')

@section('content')
    <section class="main mt-4 admin-wrapper">
        <div class="container">
            <div class="row dictionaries-section" data-uri="{{route('admin.dictionaries.index')}}">
                <div class="col-12 col-md-3">
                    <div class="card p-3 category-container">
                        <div class="card-body">
                            <div class="list-group mx-0 mb-2">
                                <h4>Раздел</h4>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="chapter"
                                           id="listGroupSection1" data-value="new"
                                           data-uri="{{route('dictionaries.index')}}" value="" checked="">
                                    <span>
                                        Новые
                                    </span>
                                </label>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="chapter"
                                           id="listGroupSection2" data-value="accept"
                                           data-uri="{{route('dictionaries.index')}}" @if(request()->has('chapter') && request()->chapter == "accept") checked @endif>
                                    <span>
                                        Принятые
                                    </span>
                                </label>
                                <label class="list-group-item d-flex gap-2">
                                    <input class="form-check-input flex-shrink-0" type="radio" name="chapter"
                                           id="listGroupSection3" data-value="deny"
                                           data-uri="{{route('dictionaries.index')}}" @if(request()->has('chapter') && request()->chapter == "deny") checked @endif>
                                    <span>
                                        Отказанные
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
                                @include('admin.pages.dictionaries.ajax.dictionariesSorting')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="report-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Описание отказа</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Описание отказа</label>
                        <textarea class="form-control" id="report" name="report" rows="3"></textarea>
                        <div class="invalid-feedback" for="report">
                            Please enter a message in the textarea.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary access-btn" data-type="deny" data-id="" data-uri="" data-method="PUT">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>
@endsection
