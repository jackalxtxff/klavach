@if(request()->routeIs('dictionaries.show'))

    @foreach($dictionary->comments as $comment)
        @if(count($dictionary->comments) - $loop->iteration < 7)
        <div class="comment-block d-flex text-muted {{$loop->first ? 'pt-3' : 'pt-2'}}" data-id="{{$comment->id}}">
            <div class="profile-img rounded flex-shrink-0 me-2"
                 style="{{$dictionary->user->profile->photo == null ? null : 'background-color: transparent'}}">
                @if($comment->user->profile->photo == null)
                    <i class="fas fa-user m-auto"></i>
                @else
                    <img class="rounded"
                         src="{{ $comment->user->profile->photo }}" alt="">
                @endif
            </div>
            <div class="pb-2 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark"><a class="link-underline"
                                                      href="{{route('profile.index', $comment->user->name)}}">{{$comment->user->name}}</a>
                        <span
                            class="fw-normal fs-7">{{\Jenssegers\Date\Date::parse($comment['updated_at'])->format('j F Y в H:i')}}</span></strong>
                    <div class="action-block">
                        @if($comment->user->id == \Illuminate\Support\Facades\Auth::id())
                            <a class="update-comment" data-id="{{$dictionary->id}}"
                               data-uri="{{route('comment.update', $comment->id)}}" data-method="PUT">Изменить</a>
                            <a class="delete-comment" data-id="{{$dictionary->id}}"
                               data-uri="{{route('comment.destroy', $comment->id)}}" data-method="DELETE">Удалить</a>
                        @endif
                    </div>
                </div>
                <span class="d-block">{{$comment->comment}}</span>
            </div>
        </div>
        @endif

    @endforeach

@else

    @foreach($dictionary->comments as $comment)

        <div class="comment-block d-flex text-muted {{$loop->first ? 'pt-3' : 'pt-2'}}" data-id="{{$comment->id}}">
            <div class="profile-img rounded flex-shrink-0 me-2"
                 style="{{$dictionary->user->profile->photo == null ? null : 'background-color: transparent'}}">
                @if($comment->user->profile->photo == null)
                    <i class="fas fa-user m-auto"></i>
                @else
                    <img class="rounded"
                         src="{{ $comment->user->profile->photo }}" alt="">
                @endif
            </div>
            <div class="pb-2 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark"><a class="link-underline"
                                                      href="{{route('profile.index', $comment->user->name)}}">{{$comment->user->name}}</a>
                        <span
                            class="fw-normal fs-7">{{\Jenssegers\Date\Date::parse($comment['updated_at'])->format('j F Y в H:i')}}</span></strong>
                    <div class="action-block">
                        @if($comment->user->id == \Illuminate\Support\Facades\Auth::id())
                            <a class="update-comment" data-id="{{$dictionary->id}}"
                               data-uri="{{route('comment.update', $comment->id)}}" data-method="PUT">Изменить</a>
                            <a class="delete-comment" data-id="{{$dictionary->id}}"
                               data-uri="{{route('comment.destroy', $comment->id)}}" data-method="DELETE">Удалить</a>
                        @endif
                    </div>
                </div>
                <span class="d-block">{{$comment->comment}}</span>
            </div>
        </div>

    @endforeach

@endif

@if(count($dictionary->comments)<1)
    <p class="mb-0 pt-2 text-muted">Комментариев нет. Будьте первым!</p>
@endif
