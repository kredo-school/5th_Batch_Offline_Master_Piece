<a href="{{url()->previous()}}" class="fw-bold text-decoration-none main-text btn border-0">
    <div class="h2 fw-semibold">
        <i class="fa-solid fa-caret-left"></i>
        <div class="d-inline main-text">Back</div>
    </div>
</a>

<div class="row justify-content-center mt-3">
    <div class="row col-9 bg-white rounded shadow">
        <div class="col-3 text-center pt-5">
            <img src="{{ asset('images/IMG_9633.jpg') }}" alt="$user->id" class="avatar-lg">
            <p class="fw-bolder fs-32">Username</p>
        </div>
        <div class="col-9 p-5">
            <p class="fs-24 fw-bold">Introduction</p>
            <p class="fs-24 fw-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim officia deserunt dolorem obcaecati sequi eveniet soluta, fugit, dolorum nam neque minima numquam? Accusamus, quos maxime. Distinctio officiis unde libero dolores.
            </p>
            <div class="text-end">
                <a href="{{route('profile.edit')}}" class="btn btn-orange ">Edit Profile</a>

            </div>


        </div>


    </div>
</div>
