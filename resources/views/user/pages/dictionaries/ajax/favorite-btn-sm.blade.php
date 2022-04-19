@if(count($dictionary['favorites']) < 1)
    <button type="button" data-type="btn-sm" data-id="{{$dictionary['id']}}" data-uri="{{route('favorites.store')}}" data-method="POST" class="btn btn-sm btn-warning favorite-btn">Добавить</button>
@else
    <a href="{{route('training.show', $dictionary['id'])}}">
        <button type="button" class="btn btn-sm btn-warning play-btn">
            Играть
        </button>
    </a>
{{--    <button type="button" data-type="btn-sm" data-id="{{$dictionary['id']}}" data-uri="{{route('favorites.destroy', $dictionary['favorites'][0]['id'])}}" data-method="DELETE" class="btn btn-sm btn-danger favorite-btn">Удалить</button>--}}
    <a class="link-danger link-sm favorite-btn" data-type="btn-sm" data-id="{{$dictionary['id']}}" data-uri="{{route('favorites.destroy', $dictionary['favorites'][0]['id'])}}" data-method="DELETE"><i style="font-size: 12px" class="fa-solid fa-xmark"></i> Убрать</a>
@endif
