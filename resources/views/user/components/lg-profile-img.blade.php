<div class="profile-img rounded">
    @if($user->profile->photo == null)
        <i class="fas fa-user m-auto"></i>
    @else
        <img class="rounded" src="{{ $user->profile->photo }}" alt="">
    @endif
</div>
