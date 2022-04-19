@extends('user.templates.template')

@section('title', 'История')

@section('content')
    <section class="main mt-4">
        <div class="container">
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
                            <h3 class="mb-3">История</h3>
                            <div class="games-container">
                                @include('user.pages.profile.history.components.gamesHistory')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
