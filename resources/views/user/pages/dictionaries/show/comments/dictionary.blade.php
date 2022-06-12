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
                                <div class="col-12">
                                    <div class="my-3 p-3 rounded comments">
                                        <h6 class="border-bottom pb-2 mb-0">Все комментарии <i
                                                class="fa-solid fa-comment-dots"></i></h6>
                                        <div class="small-comments-container">
                                            @include('user.pages.dictionaries.show.components.comments')
                                        </div>
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
    </section>
@endsection
