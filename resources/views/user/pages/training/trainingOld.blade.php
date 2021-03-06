@extends('user.templates.template')

@section('title', 'Тренажер')

@section('content')
    <section class="main mt-4">
        <div class="container">
            <div class="d-flex">
                <h1 class="me-auto">{{$dictionary['title']}}</h1>
                <div class="btn-container">
                    <button type="button" data-type="btn-lg" data-id="{{$dictionary['id']}}" data-method="POST" data-uri="{{route('training.getDictionary')}}"
                            class="btn btn-lg btn-primary play-game-btn">Начать
                    </button>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    @include('user.pages.training.components.dictionary-header')
                </div>
            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col-12 col-lg-10 col-xl-9 col-xxl-8">
                    <div class="card dictionary-card game-stats" data-uri="{{route('training.store')}}" data-method="POST">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="start-time me-auto">
                                    <span class="start-text">Старт через: </span><span class="time">5</span>
                                    <div class="traffic-lights">
                                        <button class="traffic-light disabled"></button>
                                        <button class="traffic-light disabled"></button>
                                        <button class="traffic-light disabled"></button>
                                        <button class="traffic-light disabled"></button>
                                        <button class="traffic-light disabled"></button>
                                    </div>
                                </div>
                                <div class="avg-speed me-2">
                                    Скорость: <span class="speed">0</span> зн/мин
                                </div>
                                <div class="avg-mistakes me-2">
                                    Ошибки: <span class="mistake">0</span> <span class="percent-mistake"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col-12 col-lg-10 col-xl-9 col-xxl-8">
                    <div class="card">
                        <div class="card-body game-block">
                            <p class="game-text">
                                @foreach($dictionary['excerpts'] as $excerpt)
                                    @foreach(explode(" ", $excerpt['excerpt']) as $word)
                                        <span class="placeholder">{{$word}}</span>
                                    @endforeach
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-9 col-xxl-8">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="inputtext" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block">
            @if($dictionary['language']['lang_code'] == 'ru')
                @include('user.pages.training.components.keyboard-ru')
            @elseif($dictionary['language']['lang_code'] == 'en')
                @include('user.pages.training.components.keyboard-en')
            @endif
            </div>
        </div>
    </section>
@endsection
