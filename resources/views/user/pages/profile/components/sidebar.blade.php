<div class="col-12 col-md-3 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="list-group">
                <a href="{{route('profile.index', $user->name)}}">
                    <button type="button"
                            class="list-group-item list-group-item-action {{request()->routeIs('profile.index') ? 'active' : null}}"
                            aria-current="true">
                        <i class="fas fa-chart-area me-2"></i>Обзор
                    </button>
                </a>
{{--                <a href="{{route('profile.stats', $user->name)}}">--}}
{{--                    <button type="button"--}}
{{--                            class="list-group-item list-group-item-action {{request()->routeIs('profile.stats') ? 'active' : null}}"--}}
{{--                            aria-current="true">--}}
{{--                        <i class="fas fa-chart-area me-2"></i>Статистика--}}
{{--                    </button>--}}
{{--                </a>--}}
                <a href="{{route('profile.history', $user->name)}}">
                    <button type="button"
                            class="list-group-item list-group-item-action {{request()->routeIs('profile.history') ? 'active' : null}}">
                        <i class="fas fa-history me-2"></i>История
                    </button>
                </a>
                @auth()
                    @if(\Illuminate\Support\Facades\Auth::id() === $user->profile->id)
                    <a href="{{route('profile.settings', \Illuminate\Support\Facades\Auth::user()->name)}}">
                        <button type="button"
                                class="list-group-item list-group-item-action {{request()->routeIs('profile.settings') ? 'active' : null}}">
                            <i class="fas fa-cog me-2"></i>Настройки
                        </button>
                    </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
