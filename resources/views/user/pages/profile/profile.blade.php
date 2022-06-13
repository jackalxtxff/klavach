@extends('user.templates.template')

@section('title', 'Профиль')

@section('content')
    <section class="main mt-4">
        <div class="container-lg">
            <div class="row">
                <div class="col-12 col-md-9 offset-md-3 mb-4">
                    @include('user.pages.profile.components.profile-header')
                </div>
            </div>
            <div class="row">
                    @include('user.pages.profile.components.sidebar')
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body profile-stats">
                            <h3 class="mb-3">Обзор</h3>
                            @if($user->profile->about != null)
                            <div class="row mb-3">
                                <label class="col-7 col-sm-4 col-xl-3 col-form-label pt-0">Обо мне</label>
                                <div class="col-5 col-sm-8 col-xl-9">
                                    <p>{{$user->profile->about}}</p>
                                </div>
                            </div>
                            @endif
                            <div class="row mb-3">
                                <label class="col-7 col-sm-4 col-xl-3 col-form-label pt-0">Дата регистрации</label>
                                <div class="col-5 col-sm-8 col-xl-9">
                                    <p>{{\Jenssegers\Date\Date::parse($user->profile['created_at'])->format('j F Y в H:i')}}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-7 col-sm-4 col-xl-3 col-form-label pt-0">Сыграно раз</label>
                                <div class="col-5 col-sm-8 col-xl-9">
                                    <p><span>{{$user->profile['count_games']}}</span> раз</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-7 col-sm-4 col-xl-3 col-form-label pt-0">Средняя скорость</label>
                                <div class="col-5 col-sm-8 col-xl-9">
                                    <p><span>{{round($user->profile['avg_speed'])}}</span> зн/мин</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-7 col-sm-4 col-xl-3 col-form-label pt-0">Рекордная скорость</label>
                                <div class="col-5 col-sm-8 col-xl-9">
                                    <p><span>{{round($user->profile['record_speed'])}}</span> зн/мин</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-7 col-sm-4 col-xl-3 col-form-label pt-0">Позиция в рейтинге</label>
                                <div class="col-5 col-sm-8 col-xl-9">
                                    <p><span>{{$place}}</span> место</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-7 col-sm-4 col-xl-3 col-form-label pt-0">Любимый словарь</label>
                                <div class="col-5 col-sm-8 col-xl-9">
                                    @if(empty($dictionary))
                                        <span>Нет статистики</span>
                                    @else
                                        <a class="link-underline" href="{{route('dictionaries.show', $dictionary['id'])}}">{{$dictionary['title']}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
