<nav class="nav nav-underline">
    <a class="nav-link {{request()->routeIs('dictionaries.show') ? 'text-dark' : 'text-secondary'}}" href="{{route('dictionaries.show', $dictionary)}}">Информация</a>
    @if(count($dictionary->games) > 0)
        <a class="nav-link {{request()->routeIs('dictionaries.showRecords') ? 'text-dark' : 'text-secondary'}}" href="{{route('dictionaries.showRecords', $dictionary)}}">Рекорды</a>
    @endif
    @if(count($dictionary->comments) > 0)
        <a class="nav-link text-secondary" href="">Комментарии <span class="badge bg-light text-dark rounded-pill align-text-bottom">{{count($dictionary->comments)}}</span></a>
    @endif
</nav>
