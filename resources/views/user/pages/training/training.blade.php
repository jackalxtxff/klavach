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
                    <div class="card">
                        <div class="card-body game-block">
                            <div class="row">
                                <div class="col-10">
                                    <div class="hidden-text d-flex align-items-center justify-content-center">
                                        <p>Текст скрыт до начала</p>
                                    </div>
                                    <p class="game-text">
{{--                                        @foreach($dictionary['excerpts'] as $excerpt)--}}
{{--                                            @foreach(explode(" ", $excerpt['excerpt']) as $word)--}}
{{--                                                <span class="placeholder">{{$word}}</span>--}}
{{--                                            @endforeach--}}
{{--                                        @endforeach--}}
                                    </p>
                                </div>
                                <div class="col-2 game-stats" data-uri="{{route('training.store')}}" data-method="POST">
                                    <div class="start-time pb-3">
                                        <div class="text-muted"><i class="fa-solid fa-stopwatch me-2"></i>ВРЕМЯ:</div>
                                        <span class="time">5</span>
                                    </div>
                                    <div class="avg-speed pb-3">
                                        <div class="text-muted"><i class="fa-solid fa-gauge-high me-2"></i>СКОРОСТЬ:</div>
                                        <div><span class="speed">0</span> зн/мин</div>
                                    </div>
                                    <div class="avg-mistakes">
                                        <div class="text-muted"><i class="fa-solid fa-bomb me-2"></i>ОШИБКИ: </div>
                                        <div><span class="mistake">0</span> <span class="percent-mistake"></span></div>
                                    </div>
                                </div>
                            </div>

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
