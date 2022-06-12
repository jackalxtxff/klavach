@extends('user.templates.template')
@section('title', $dictionary['title'])

@section('content')
    <section class="main mt-4 dictionary">
        <div class="container-lg">
            <div class="d-flex">
                <h1 class="me-auto">{{$dictionary['title']}}</h1>
                <div class="btn-container">
                    @include('user.pages.dictionaries.ajax.favorite-btn-lg')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header px-0">
                            @include('user.pages.dictionaries.show.components.nav')
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label pt-0">Автор</label>
                                    <div class="col-sm-10">
                                        @if($dictionary->is_systemic == 1) <span>Cистемный</span> @endif
                                        @if($dictionary->is_systemic == 0)
                                            <div class="profile-img rounded align-middle"
                                                 style="width: 20px; height: 20px; {{$dictionary->user->profile->photo == null ? null : 'background-color: transparent'}}">
                                                @if($dictionary->user->profile->photo == null)
                                                    <i class="fas fa-user m-auto" style="font-size: 14px"></i>
                                                @else
                                                    <img class="rounded" src="{{ $dictionary->user->profile->photo }}"
                                                         alt="">
                                                @endif
                                            </div>
                                            <a class="link-underline"
                                               href="{{route('profile.index', $dictionary->user->name)}}">{{$dictionary['user']['name']}}</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label pt-0">Описание</label>
                                    <div class="col-sm-10">
                                        <p>{{$dictionary['description']}}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label pt-0">Информация</label>
                                    <div class="col-sm-10">
                                        <p>{{$dictionary['information']}}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label pt-0">Ваша оценка</label>
                                    <div class="col-sm-10">
                                        @include('user.pages.dictionaries.show.components.grade-stars')
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label pt-0">Дата создания</label>
                                    <div class="col-sm-10">
                                        <p>{{\Jenssegers\Date\Date::parse($dictionary['created_at'])->format('j F Y в H:i')}}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label pt-0">Публичный</label>
                                    <div class="col-sm-10">
                                        <p>{{$dictionary['is_publish'] == 1 ? 'Да' : 'Нет'}}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label pt-0">Язык</label>
                                    <div class="col-sm-10">
                                        <p>{{$dictionary['language']['language']}}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label pt-0">Тип словаря</label>
                                    <div class="col-sm-10">
                                        <div class="form-check p-0">
                                            <label class="form-check-label" for="words">
                                                {{$dictionary['type']['type']}}
                                            </label>
                                            <div class="form-text">Текст для игры будет составляться из слов введенного
                                                вами текста, перемешанных в случайном порядке
                                            </div>
                                        </div>
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label pt-0">Содержание</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="content" name="content"
                                                  readonly
                                                  rows="5">@foreach($dictionary['excerpts'] as $excerpt){{$excerpt['excerpt']}}{{$loop->last ? "" : "\n"}}@endforeach</textarea>
                                        <div class="form-text">Содержимое словаря</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="my-3 p-3 rounded comments">
                                            <h6 class="border-bottom pb-2 mb-0">Недавние комментарии <i
                                                    class="fa-solid fa-comment-dots"></i></h6>
                                            <div class="small-comments-container">
                                                @include('user.pages.dictionaries.show.components.comments')
                                            </div>
                                            <small class="d-block text-end mt-2">
                                                @if(count($dictionary->comments))
                                                    <a href="{{route('dictionaries.showComments', $dictionary->id)}}">Смотреть все</a>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="comment"
                                                   placeholder="Написать комментарий"
                                                   aria-label="comment">
                                            <button type="submit" class="btn btn-secondary send-comment"
                                                    data-id="{{$dictionary->id}}" data-uri="{{route('comment.store')}}"
                                                    data-method="POST">Написать
                                            </button>
                                            <button type="submit" class="btn btn-secondary send-update-comment d-none">
                                                Изменить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
