@if(count($dictionary['favorites']) < 1)
    <button type="button" data-type="btn-lg" data-id="{{$dictionary['id']}}" data-uri="{{route('favorites.store')}}" data-method="POST" class="btn btn-lg btn-warning favorite-btn">Добавить</button>
@else
    <a href="{{route('training.show', $dictionary['id'])}}">
        <button type="button" class="btn btn-lg btn-warning play-btn">
            Играть
        </button>
    </a>
    <button type="button" data-type="btn-lg" data-id="{{$dictionary['id']}}" data-uri="{{route('favorites.destroy', $dictionary['favorites'][0]['id'])}}" data-method="DELETE" class="btn btn-lg btn-danger favorite-btn">Убрать</button>
@endif

@if($dictionary->user->id == \Illuminate\Support\Facades\Auth::id())
    <a href="{{route('dictionaries.edit', $dictionary->id)}}">
        <button type="button" data-type="btn-lg" data-id="{{$dictionary['id']}}"
                data-uri="{{route('dictionaries.edit', $dictionary->id)}}" data-method="DELETE"
                class="btn btn-lg btn-dark">Изменить
        </button>
    </a>
@endif
