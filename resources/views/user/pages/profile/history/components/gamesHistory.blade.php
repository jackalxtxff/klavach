@foreach($games as $key => $value)
    @if(\Jenssegers\Date\Date::parse($key)->format('j F Y') == \Jenssegers\Date\Date::now()->format('j F Y'))
        <h4>Сегодня</h4>
    @elseif(\Jenssegers\Date\Date::parse($key)->format('j F Y') == \Jenssegers\Date\Date::yesterday()->format('j F Y'))
        <h4>Вчера</h4>
    @else
        <h4>{{\Jenssegers\Date\Date::parse($key)->format('j F Y')}}</h4>
    @endif
    @foreach($value as $game)

        <div class="card dictionary-card {{$loop->index == count($value) - 1 && count($value) > 1 ? 'mb-4' : 'mb-2'}}">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        {{--                                            <img src="{{asset('img/img.png')}}" style="max-width: 60px" class="float-start me-1" alt="">--}}
                        <h5 class="dictionary-title mb-0"><a
                                href="{{route('dictionaries.show', $game['dictionary']['id'])}}">{{$game['dictionary']['title']}}</a></h5>
                        <p class="dictionary-description mb-0">{{$game['dictionary']['description']}}</p>
                        <p class="dictionary-author mb-0">Автор: <a class="link-underline" href="{{route('profile.index', $game['dictionary']['user']['name'])}}">{{$game['dictionary']['user']['name']}}</a></p>
                        <p class="dictionary-date mb-0">{{\Jenssegers\Date\Date::parse($game['created_at'])->format('j F Y в H:i')}}</p>
                    </div>
                    <div class="col-3">
                        <p class="game-speed mb-0">Ваша скорость: <span>{{round($game['avg_speed'])}}</span> зн/мин</p>
                        <p class="game-speed mb-0">Ошибки: <span>{{round($game['percent_mistakes'], 1)}}</span>%</p>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@endforeach




@if(count($games)<1)
    <p class="mb-0 text-muted">Нет истории</p>
@endif
