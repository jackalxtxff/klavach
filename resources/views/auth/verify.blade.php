@extends('user.templates.template')

@section('content')
<div class="container-lg mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Проверьте свой адрес электронной почты') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('На ваш адрес электронной почты отправлена новая ссылка для подтверждения.') }}
                        </div>
                    @endif

                    {{ __('Прежде чем продолжить, проверьте свою электронную почту на наличие ссылки для подтверждения.') }}
                    {{ __('Если вы не получили письмо') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('нажмите здесь, чтобы запросить повторно') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
