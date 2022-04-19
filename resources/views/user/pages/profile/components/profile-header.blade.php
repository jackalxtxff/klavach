<div class="card p-3 profile-header">
    <div class="card-body p-0 d-flex align-items-center">
        <div class="profile-img rounded" style="{{$user->profile->photo == null ? null : 'background-color: transparent'}}">
            @if($user->profile->photo == null)
                <i class="fas fa-user m-auto"></i>
            @else
                <img class="rounded" src="{{ $user->profile->photo }}" alt="">
            @endif
        </div>
        <span class="nickname fs-3 ms-3">{{$user->name}}</span>
    </div>
</div>
