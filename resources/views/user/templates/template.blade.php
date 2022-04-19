@extends('templates.template')

@section('header')
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-end">
                <a href="{{route('main')}}"
                   class="d-flex align-items-center mb-2 mb-lg-0 me-lg-auto text-white text-decoration-none"><h3>
                        Klavach</h3></a>

                <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0">
                    @guest
                        <li><a href="{{route('main')}}"
                               class="nav-link px-2 {{request()->routeIs('main') ? 'text-secondary' : 'text-white'}}">Главная</a>
                        </li>
                    @endguest
                    <li><a href="{{route('learn')}}"
                           class="nav-link px-2 {{request()->routeIs('learn') ? 'text-secondary' : 'text-white'}}">Обучение</a>
                    </li>
                    <li><a href="{{route('training.index')}}"
                           class="nav-link px-2 {{request()->routeIs('training.index') ? 'text-secondary' : 'text-white'}}">Тренажер</a>
                    </li>
                    <li><a href="{{route('dictionaries.index')}}"
                           class="nav-link px-2 {{request()->routeIs('dictionaries.index') ? 'text-secondary' : 'text-white'}}">Словари</a>
                    </li>
                    <li><a href="{{route('rating')}}"
                           class="nav-link px-2 {{request()->routeIs('rating') ? 'text-secondary' : 'text-white'}}">Рейтинг</a>
                    </li>
                    @auth()
                        @if(auth()->user()->role == 'admin')
                            <li><a href="{{route('admin.dictionaries.index')}}" class="nav-link px-2 text-white">Пользователь</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                @guest
                    <div class="text-end">
                        <a href="{{route('login')}}">
                            <button type="button" class="btn btn-outline-light me-2">Вход</button>
                        </a>
                        <a href="{{route('register')}}">
                            <button type="button" class="btn btn-warning">Регистрация</button>
                        </a>
                    </div>
                @else
                    <div class="flex-shrink-0 ms-2 dropdown">
                        <a href="#" class="d-block text-white text-decoration-none dropdown-toggle" id="dropdownUser"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
                            <li><a class="dropdown-item" href="{{route('profile.index', \Illuminate\Support\Facades\Auth::user()->name)}}"><i
                                        class="far fa-user me-2"></i>Профиль</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{route('profile.stats', \Illuminate\Support\Facades\Auth::user()->name)}}"><i
                                        class="fas fa-chart-area me-2"></i>Статистика</a></li>
                            <li><a class="dropdown-item" href="{{route('profile.history', \Illuminate\Support\Facades\Auth::user()->name)}}"><i
                                        class="fas fa-history me-2"></i>История</a></li>
                            <li><a class="dropdown-item" href="{{route('profile.settings', \Illuminate\Support\Facades\Auth::user()->name)}}"><i
                                        class="fas fa-cog me-2"></i>Настройки</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                        class="fas fa-sign-out-alt me-2"></i>Выход</a></li>
                        </ul>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </header>
@endsection
