<div class="card dictionary-card">
    <div class="card-body">
        <div class="row">
            <div class="col-9">
                {{--                                            <img src="{{asset('img/img.png')}}" style="max-width: 60px" class="float-start me-1" alt="">--}}
                <h5 class="dictionary-title mb-0"><a
                        href="{{route('dictionaries.show', $dictionary['id'])}}">{{$dictionary['title']}}</a></h5>
                <p class="dictionary-description mb-0">{{\Illuminate\Support\Str::limit($dictionary['description'], 100)}}</p>
                <p class="dictionary-author mb-0 d-inline">
                    Автор:
                <div class="profile-img rounded align-middle" style="width: 20px; height: 20px; {{$dictionary->user->profile->photo == null ? null : 'background-color: transparent'}}">
                    @if($dictionary->user->profile->photo == null)
                        <i class="fas fa-user m-auto" style="font-size: 14px"></i>
                    @else
                        <img class="rounded" src="{{ $dictionary->user->profile->photo }}" alt="">
                    @endif
                    </div>
                <a class="link-underline" href="{{route('profile.index', $dictionary->user->name)}}">{{$dictionary['user']['name']}}</a>
                </p>
            </div>
            <div class="col-3">
                <p class="dictionary-grade mb-0"><span
                        class="badge rounded-pill me-1 align-baseline
                         @if(round($dictionary['stats']['avg_grade'], 1) < 3)
                            bg-danger
@elseif(round($dictionary['stats']['avg_grade'], 1) < 4)
                            bg-warning
@elseif(round($dictionary['stats']['avg_grade'], 1) <= 5)
                            bg-success
@endif
                            ">{{round($dictionary['stats']['avg_grade'], 1)}}</span><span
                        class="dictionary-count-comment">100</span> комментариев</p>
                <p class="dictionary-difficulty mb-0">Сложность: <span>сложная</span></p>
                <p class="dictionary-speed mb-0">Средняя скорость: <span>{{round($dictionary['stats']['avg_speed'])}}</span> зн/мин</p>
            </div>
        </div>
    </div>
</div>
