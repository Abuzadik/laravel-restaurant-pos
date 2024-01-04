@extends('layouts.app')

@section('content')
<div class="m-4">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                <div class="card-body">
                    <div class="list-group list-group-light">
                        <a href="/general" class="list-group-item list-group-item-action "><i
                                class="fa-solid fa-gears fa-lg"></i> <strong>General</strong> </a>
                        <a href="/general/usernames" class="list-group-item list-group-item-action"><i
                                class="fa-solid fa-users fa-lg"></i> Users </a>
                        <!-- <a href="#" class="list-group-item list-group-item-action"><i
                                class="fa-solid fa-gear fa-lg"></i>System</a> -->
                        <a href="/general/profile" class="list-group-item list-group-item-action active"><i
                                class="fa-solid fa-user fa-lg"></i> <strong> Profile </strong> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row text-success">
                        <div class="col-6">
                            <h2>Profile Information</h2>
                        </div>
                        <div class="col-6">
                            <h2 class=" font-weight-bold">Change Password</h2>
                        </div>
                    </div>
                    <hr>
                    @if(session()->has('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="profile-info m-4 row">
                        <div class="profile-field col-6">
                            <label for="name">
                                <span class="label"><i class="fa-solid fa-user"></i> &nbsp; <strong>USERNAME</strong></span><br>
                                <span class="value">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$user->name}}</span>
                            </label> <br> <br>

                            <label for="email">
                                <span class="label"><i class="fa-solid fa-envelope"></i> &nbsp; <strong>EMAIL</strong></span> <br>
                                <span class="value">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$user->email}}</span>
                            </label><br> <br>
                            <label for="role">
                                <span class="label"><i class="fa-solid fa-certificate"></i> &nbsp; <strong>ROLE</strong></span> <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="value badge rounded-pill bg-success" >{{$user->role}}</span>
                            </label>
                        </div>
                        <div class="profile-field col-6 mt-3">
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li> {{$error}}</li>
                                    @endforeach

                                </ul>
                            </div>
                            @endif
                            <form method="POST" action="{{ route('change.password') }}">
                                @csrf

                                <div class="form-floating mb-3">
                                    <input type="password" name="current_password" class="form-control"
                                        id="current_password" placeholder="Current Password" required>
                                    <label for="current_password">Current Password</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <div class="input-group">
                                        <input type="password" name="new_password" placeholder="new password" class="form-control"
                                            id="new_password"  required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary"  type="button"
                                                id="toggleNewPassword">
                                                <i class="fa-regular fa-eye-slash"></i>
                                            </button>
                                                
                                        </div>
                                    </div>
                                    <!-- <label for="new_password">New Password</label> -->
                                </div>

                                <div class="form-floating mb-3">
                                    <div class="input-group">
                                        <input type="password" name="confirm_password" class="form-control"
                                            id="confirm_password" placeholder="Confirm Password" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="toggleConfirmPassword"><i class="fa-regular fa-eye-slash"></i></button>
                                        </div>
                                    </div>
                                    <!-- <label for="confirm_password">Confirm Password</label> -->
                                </div>

                                <button type="submit" class="btn btn-primary">Change</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    $("#toggleNewPassword").click(function() {
        togglePasswordVisibility("#new_password", "#toggleNewPassword");
    });

    $("#toggleConfirmPassword").click(function() {
        togglePasswordVisibility("#confirm_password", "#toggleConfirmPassword");
    });

    function togglePasswordVisibility(inputSelector, buttonSelector) {
        var passwordInput = $(inputSelector);
        var type = passwordInput.attr("type") === "password" ? "text" : "password";
        passwordInput.attr("type", type);
        $(buttonSelector).html(type === "password" ? '<i class="fa-regular fa-eye-slash"></i>' : '<i class="fa-regular fa-eye"></i>');
    }
});

</script>
@endsection