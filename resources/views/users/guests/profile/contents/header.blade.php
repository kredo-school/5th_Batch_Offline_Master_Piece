<a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
    <div class="h2 fw-semibold">
        <i class="fa-solid fa-caret-left"></i>
        <div class="d-inline main-text">Back</div>
    </div>
</a>

<div class="row justify-content-center mt-3">
    <div class="row col-9 bg-white rounded shadow">
        <div class="col-sm-3 text-center pt-5">
            @if (optional($user->profile)->avatar)
                <img src="{{ optional($user->profile)->avatar }}" alt="{{ $user->name }}"
                    class="rounded-circle shadow p-1 avatar-lg d-block mx-auto ">
            @else
                <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
            @endif
            <p class="fw-bolder fs-32">{{$user->name}}</p>
        </div>
        <div class="col-sm-9 p-5 row">
            <p class="fs-24 fw-bold col-6">Introduction</p>
            @if (Auth::user()->id === $user->id)
                <div class="text-end col-6">
                    <a href="{{ route('profile.edit') }}" class="btn btn-orange ">Edit Profile</a>
                </div>
            @endif
            <p class="fs-24 fw-light wrap-text col-12">{{ optional($user->profile)->introduction }}</p>

        </div>


    </div>
</div>
