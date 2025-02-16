@extends('layouts.studentForm')

@section('title', 'Profile Update Form')

@section('action', route('studentUpdateProfile'))

@section('formContent')
    <div>
        <label for="fName" class="form-label mt-3 fs-5">First Name:</label>
        <input type="text" class="form-control p-2 mt-2 @error('fName') is-invalid @enderror" id="fName" name="fName"
            placeholder="Enter your First Name" value="{{ old('fName') ?? $data['first_name'] }}">
    </div>
    @error('fName')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="lName" class="form-label mt-4 fs-5">Last Name:</label>
        <input type="text" class="form-control p-2 mt-2 @error('lName') is-invalid @enderror" id="lName"
            name="lName" placeholder="Enter your Last Name" value="{{ old('lName') ?? $data['last_name'] }}">
    </div>
    @error('lName')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="email" class="form-label mt-4 fs-5">Email:</label>
        <input type="email" class="form-control p-2 mt-2 @error('email') is-invalid @enderror" id="email"
            name="email" placeholder="Enter Username" value="{{ old('email') ?? $data['email'] }}">
    </div>
    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="username" class="form-label mt-4 fs-5">Username:</label>
        <input type="text" class="form-control p-2 mt-2 @error('username') is-invalid @enderror" id="username"
            name="username" placeholder="Enter Username" value="{{ old('username') ?? $data['username'] }}">
    </div>
    @error('username')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="role" class="form-label mt-4 fs-5 @error('role') is-invalid @enderror">Role:</label>
        <select class="form-select" aria-label="Default select example" name="role" value="{{ old('role') ?? $data['role'] }}">
            <option value="student">Student</option>
            <option value="instructor">Instructor</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    @error('role')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="profile_picture" class="form-label mt-4 fs-5 @error('profile_picture') is-invalid @enderror">Profile
            Picure:</label>
        <input type="file" class="form-control p-2 mt-2" id="profile_picture" name="profile_picture"
            value="{{ old('profile_picture') ?? $data['profile_picture'] }}">
    </div>
    @error('profile_picture')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="submit" value="Update Profile" class="btn btn-danger rounded mt-4 mb-4 px-3 fs-5 col-12">
@endsection

@section('image')
    <img class="d-none d-lg-flex mt-0 mt-lg-5" src="{{ asset('img/manage_profile.avif') }}" style="width: 100%; object-fit:contain" alt="">
@endsection
</div>
