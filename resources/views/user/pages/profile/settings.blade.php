@extends('user.templates.template')

@section('title', 'Настройки')

@section('content')
    <section class="main mt-4">
        <div class="container-lg">
            <div class="row">
                <div class="col-12 col-md-9 offset-md-3 mb-4">
                    @include('user.pages.profile.components.profile-header')
                </div>
            </div>
            <div class="row">
                    @include('user.pages.profile.components.sidebar')
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-3">Настройки</h3>
                            <div class="row">
                                <div class="col-sm-9 col-md-8 col-lg-7 col-xl-6 col-xxl-5">

                                    <div class="d-flex align-items-end">
                                        <div class="profile-img rounded me-2" style="{{$user->profile->photo == null ? null : 'background-color: transparent'}}">
                                            @if($user->profile->photo == null)
                                                <i class="fas fa-user m-auto"></i>
                                            @else
                                                <img class="rounded"
                                                     src="{{ $user->profile->photo }}"
                                                     alt="">
                                            @endif
                                        </div>
                                        <div>
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#image-modal">Изменить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-9 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                                    <div class="input-gp mb-2">
                                        <label for="about" class="form-label">Обо мне</label>
                                        <div class="input-group has-validation">
                                            <textarea class="form-control" id="about" name="about" placeholder="">{{$user->profile->about}}</textarea>
                                            <button class="btn btn-primary change-about" data-method="PUT" data-uri="{{route('profile.update', $user->id)}}" type="submit">Изменить</button>
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                                    <div class="input-gp mb-2">
                                        <label for="name" class="form-label">Никнейм</label>
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control" id="name" name="name"
                                                   aria-describedby="inputGroupPrepend" placeholder="Ваше имя" required="" value="{{$user->name}}">
                                            <button class="btn btn-primary change-name" data-method="PUT" data-uri="{{route('profile.update', $user->id)}}" type="submit">Изменить</button>
                                            <div class="invalid-feedback" for="name">
                                                Please choose a username.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                                    <div class="input-gp mb-2">
                                        <label for="email" class="form-label">Электронная почта</label>
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control" id="email" name="email"
                                                   aria-describedby="inputGroupPrepend" placeholder="example@company.com" disabled value="{{$user->email}}">
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                            <button class="btn btn-primary change-email" disabled type="submit">Изменить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col-12">--}}
{{--                                    <button class="btn btn-primary" type="submit">Изменить</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <hr class="divider">
                            <h4>Изменение пароля</h4>
                            <div class="password-group">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-gp mb-2">
                                            <label for="current_password" class="form-label">Текущий пароль</label>
                                            <div class="input-group has-validation">
                                                <input type="password" class="form-control" id="current_password" name="current_password"
                                                       aria-describedby="inputGroupPrepend" placeholder="Текущий пароль" required="">
                                                <div class="invalid-feedback" for="current_password">
                                                    Please choose a username.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-gp mb-2">
                                            <label for="new_password" class="form-label">Новый пароль</label>
                                            <div class="input-group has-validation">
                                                <input type="password" class="form-control" id="new_password"
                                                       name="new_password"
                                                       aria-describedby="inputGroupPrepend" placeholder="Новый пароль"
                                                       required="">
                                                <div class="invalid-feedback" for="new_password">
                                                    Please choose a username.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-gp mb-2">
                                            <label for="new_password_confirmation" class="form-label">Подтвердите
                                                пароль</label>
                                            <div class="input-group has-validation">
                                                <input type="password" class="form-control" id="new_password_confirmation"
                                                       name="new_password_confirmation"
                                                       aria-describedby="inputGroupPrepend"
                                                       placeholder="Подтвердите пароль" required="">
                                                <div class="invalid-feedback" for="new_password_confirmation">
                                                    Please choose a username.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary change-password" data-method="PUT"
                                                data-uri="{{route('profile.update', $user->id)}}" type="submit">
                                            Сохранить
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

    <div class="modal fade" id="image-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Изменить аватар</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-7">
                            <div class="img-container">
                                <img id="image" src="{{ $user->profile->photo == null ? null : $user->profile->photo }}" alt="">
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="docs-preview clearfix mb-3">
                                <h5 class="ps-0">Превью</h5>
                                <div class="img-preview preview-lg"><img style="width: 144px; height: 144px;"></div>
                                <div class="img-preview preview-md"><img style="width: 72px; height: 72px;"></div>
                                <div class="img-preview preview-sm"><img style="width: 36px; height: 36px;"></div>
                                <div class="img-preview preview-xs"><img style="width: 18px; height: 18px;"></div>
                            </div>
                            <div class="img-import">
                                <h5 class="ps-0">Импорт</h5>
                                <div>
                                    <label for="formFileSm" class="form-label">Изображения в формате JPEG, PNG или GIF до 2МБ.</label>
                                    <input class="form-control form-control-sm" id="formFileSm" name="img-input" type="file" accept="image/gif, image/jpeg, image/png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete-image me-auto" {{ $user->profile->photo == null ? 'disabled' : null }} data-bs-dismiss="modal" data-uri="{{route('profile.destroy', $user->id)}}" data-method="DELETE">Удалить аватар</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary save-image" data-method="POST"
                            data-uri="{{route('profile.update', $user->id)}}">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
@endsection
