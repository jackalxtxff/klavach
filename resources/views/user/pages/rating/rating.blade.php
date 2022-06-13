@extends('user.templates.template')

@section('title', 'Тренажер')

@section('content')
    <section class="main mt-4">
        <div class="container-lg">
            <div class="d-flex">
                <h1 class="me-auto">Рейтинг</h1>
                @auth()
                    <div class="btn-container">
                        <a type="button" data-method="POST" class="btn btn-lg btn-warning" href="{{route('rating.index', 'page='.$page)}}">Показать меня</a>
                    </div>
                @endauth
            </div>
            <div class="card p-3">
                <div class="card-body">
                    <div class="rating-table">
                        <div class="row">
                            <div class="col-12 border rounded">
                                <div class="m-0 row p-3">
                                    <div class="col-1 p-0">
                                        <strong class="pl-lg-2">#</strong>
                                    </div>
                                    <div class="col-5 p-0">
                                        <strong>Имя</strong>
                                    </div>
                                    <div class="col-2 p-0">
                                        <strong>Рекорд</strong>
                                    </div>
                                    <div class="col-2 p-0">
                                        <strong>Среднее</strong>
                                    </div>
                                    <div class="col-2 p-0">
                                        <strong>Ошибки</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @include('user.pages.rating.components.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
