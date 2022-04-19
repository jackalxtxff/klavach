@extends('user.templates.template')
@section('title', $dictionary['title'])

@section('content')
    <section class="main mt-4 dictionary">
        <div class="container">
            <div class="d-flex">
                <h1 class="me-auto">{{$dictionary['title']}}</h1>
                <div class="btn-container">
                    @include('user.pages.dictionaries.ajax.favorite-btn-lg')
                </div>
            </div>
            <div class="row dictionary-records-container" data-uri="{{route('dictionaries.showRecords', $dictionary)}}">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header px-0">
                            <div class="d-flex">
                                <div class="me-auto">@include('user.pages.dictionaries.show.components.nav')</div>
                                <div class="p-2">
                                    {{--                                    <a class="px-2" href="">Сегодня</a>--}}
                                    {{--                                    <a class="px-2" href="">Неделя</a>--}}
                                    {{--                                    <a class="px-2" href="">За все время</a>--}}
                                    <div class="form-check form-check-inline px-2 m-0">
                                        <input class="form-check-input d-none" type="radio" name="sortRecords"
                                               id="exampleRadios1"
                                               data-value="now" {{request()->has('sort') && request()->sort == 'now' ? 'checked' : null}}>
                                        <label class="form-check-label text-secondary" for="exampleRadios1">
                                            Сегодня
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline px-2 m-0">
                                        <input class="form-check-input d-none" type="radio" name="sortRecords"
                                               id="exampleRadios2"
                                               data-value="week" {{request()->has('sort') && request()->sort == 'week' ? 'checked' : null}}>
                                        <label class="form-check-label text-secondary" for="exampleRadios2">
                                            Неделя
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline px-2 m-0">
                                        <input class="form-check-input d-none" type="radio" name="sortRecords"
                                               id="exampleRadios3"
                                               data-value="all" {{!request()->has('sort') || (request()->has('sort') && request()->sort == 'all') ? 'checked' : null}}>
                                        <label class="form-check-label text-secondary" for="exampleRadios3">
                                            Все время
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-records">
                            @include('user.pages.dictionaries.show.records.components.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
