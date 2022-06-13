@foreach($profiles as $profile)
    <div class="col-12 border rounded mt-2 mb-2" style="{{$profile->user->id == \Illuminate\Support\Facades\Auth::id() ? 'border-color: #ffc107 !important;' : null}}">
        <div class="m-0 row row-container bg-white p-3">
            <div class="col-1 p-0 pl-lg-2">
                {{($profiles->currentpage()-1) * $profiles->perpage() + $loop->iteration}}
            </div>
            <div class="col-5 p-0 p-0 pl-lg-5">
                <div class="profile-img rounded align-middle" style="width: 20px; height: 20px; {{$profile->user->profile->photo == null ? null : 'background-color: transparent'}}">
                    @if($profile->user->profile->photo == null)
                        <i class="fas fa-user m-auto" style="font-size: 14px"></i>
                    @else
                        <img class="rounded" src="{{ $profile->user->profile->photo }}" alt="">
                    @endif
                </div>
                <a class="link-underline" href="{{route('profile.index', $profile->user->name)}}">{{$profile->user->name}}</a>
            </div>
            <div class="col-2 p-0 p-0 pl-lg-5">
                {{round($profile->record_speed)}}
            </div>
            <div class="col-2 p-0 p-0 pl-lg-5">
                {{round($profile->avg_speed)}}
            </div>
            <div class="col-2 p-0">
                {{round($profile->avg_mistakes, 2)}}%
            </div>
        </div>
    </div>
@endforeach
<div class="d-flex justify-content-center">
    {!! $profiles->links() !!}
</div>
