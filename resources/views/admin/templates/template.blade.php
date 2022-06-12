@extends('templates.template')

@section('header')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Eighth navbar example">
        <div class="container-lg">
            <a class="navbar-brand" href="{{route('main')}}"><h3>Klavach</h3></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                    aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @guest
                        <li class="nav-item">
                            <a href="{{route('main')}}"
                               class="nav-link {{request()->routeIs('main') ? 'active' : ''}}">Главная</a>
                        </li>
                    @endguest
                    <li class="nav-item">
                        <a href="{{route('dictionaries.index')}}"
                           class="nav-link {{request()->routeIs('admin.dictionaries.index') ? 'active' : ''}}">Словари</a>
                    </li>
                    @auth()
                        @if(auth()->user()->role == 'admin')
                            <li class="nav-item">
                                <a href="{{route('dictionaries.index')}}" class="nav-link">Пользователь</a>
                            </li>
                        @endif
                    @endauth
                    @auth()
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{request()->routeIs('profile.index') || request()->routeIs('profile.stats') || request()->routeIs('profile.history') || request()->routeIs('profile.settings') ? 'active' : ''}}"
                               href="#" id="dropdownUser" data-bs-toggle="dropdown"
                               aria-expanded="false">{{ auth()->user()->name }}</a>
                            <ul class="dropdown-menu shadow" aria-labelledby="dropdownUser">
                                <li><a class="dropdown-item"
                                       href="{{route('profile.index', \Illuminate\Support\Facades\Auth::user()->name)}}"><i
                                            class="far fa-user me-2"></i>Профиль</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                       href="{{route('profile.stats', \Illuminate\Support\Facades\Auth::user()->name)}}"><i
                                            class="fas fa-chart-area me-2"></i>Статистика</a></li>
                                <li><a class="dropdown-item"
                                       href="{{route('profile.history', \Illuminate\Support\Facades\Auth::user()->name)}}"><i
                                            class="fas fa-history me-2"></i>История</a></li>
                                <li><a class="dropdown-item"
                                       href="{{route('profile.settings', \Illuminate\Support\Facades\Auth::user()->name)}}"><i
                                            class="fas fa-cog me-2"></i>Настройки</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                            class="fas fa-sign-out-alt me-2"></i>Выход</a></li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endauth
                </ul>
                @guest()
                    <div class="">
                        <a href="{{route('login')}}">
                            <button type="button" class="btn btn-outline-light me-2">Вход</button>
                        </a>
                        <a href="{{route('register')}}">
                            <button type="button" class="btn btn-warning">Регистрация</button>
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
{{--    <header class="p-3 bg-dark text-white">--}}
{{--        <div class="container">--}}
{{--            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end">--}}
{{--                <a href="{{route('main')}}" class="d-flex align-items-center mb-2 mb-lg-0 me-lg-auto text-white text-decoration-none"><h3>Klavach</h3></a>--}}

{{--                <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0">--}}
{{--                    @guest--}}
{{--                        <li><a href="{{route('main')}}" class="nav-link px-2 {{request()->routeIs('main') ? 'text-secondary' : 'text-white'}}">Главная</a></li>--}}
{{--                    @endguest--}}
{{--                    <li><a href="{{route('admin.dictionaries.index')}}" class="nav-link px-2 {{request()->routeIs('admin.dictionaries.index') ? 'text-secondary' : 'text-white'}}">Словари</a></li>--}}
{{--                    @if(auth()->user()->role == 'admin')--}}
{{--                        <li><a href="{{route('rating')}}" class="nav-link px-2 {{request()->routeIs('rating') ? 'text-secondary' : 'text-white'}}">Админ</a></li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--                @guest--}}
{{--                    <div class="text-end">--}}
{{--                        <a href="{{route('login')}}">--}}
{{--                            <button type="button" class="btn btn-outline-light me-2">Вход</button>--}}
{{--                        </a>--}}
{{--                        <a href="{{route('register')}}">--}}
{{--                            <button type="button" class="btn btn-warning">Регистрация</button>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="flex-shrink-0 ms-2 dropdown">--}}
{{--                        <a href="#" class="d-block text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                            {{ auth()->user()->name }}--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">--}}
{{--                            <li><a class="dropdown-item" href="{{route('profile.index', auth()->user()->name)}}"><i class="far fa-user me-2"></i>Профиль</a></li>--}}
{{--                            <li><hr class="dropdown-divider"></li>--}}
{{--                            <li><a class="dropdown-item" href="{{route('profile.index', auth()->user()->name)}}"><i class="fas fa-chart-area me-2"></i>Статистика</a></li>--}}
{{--                            <li><a class="dropdown-item" href="{{route('profile.history', auth()->user()->name)}}"><i class="fas fa-history me-2"></i>История</a></li>--}}
{{--                            <li><a class="dropdown-item" href="{{route('profile.settings', auth()->user()->name)}}"><i class="fas fa-cog me-2"></i>Настройки</a></li>--}}
{{--                            <li><hr class="dropdown-divider"></li>--}}
{{--                            <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i>Выход</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                        @csrf--}}
{{--                    </form>--}}
{{--                @endguest--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </header>--}}
@endsection
