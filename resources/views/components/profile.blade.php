<div class="row">
    <div class="card w-25">
        <img src="{{asset(Storage::url('profile_images/'.$user->profile_image))}}" class="card-img-top"
            alt="Profile picture">
        <div class="card-body">
            <div class="card-title text-center fw-bold text-dark">
                {{$user->first_name}}
                {{$user->last_name}}
            </div>
        </div>
    </div>

    <div class="card w-75">
        <div class="card-body">
            <table class="table table-stripped border table-hover">
                <tbody>
                    <tr>
                        <td class="fw-bold">Email</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Address</td>
                        <td>{{$user->address}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Date of birth</td>
                        <td>{{$user->dob}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Role</td>
                        <td>{{$user->role}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{route('profile.edit')}}" class="btn btn-primary">Edit Profile</a>
            <a href="{{route('password.edit')}}" class="btn btn-primary">Change Password</a>
            <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#delete">Delete Account
            </a>

        </div>
    </div>
</div>

<x-modal title="Confirm delete" body="Are you sure you want to delete your account?" routeName="profile.destroy" modal ="delete" />