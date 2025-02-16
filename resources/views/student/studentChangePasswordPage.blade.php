@extends('layouts.instructorForm')

@section('title', 'Profile Update Form')

@section('action', route('studentChangePassword'))

@section('formContent')
    <div>
        <label for="oldPwd" class="form-label mt-3 fs-5">Old Passsword:</label>
        <input type="password" class="form-control p-2 mt-2 @if(session('unMatch')) is-invalid @endif @error('oldPwd') is-invalid @enderror" id="oldPwd" name="oldPwd"
            placeholder="Enter Old Passsword">
    </div>
    @error('oldPwd')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    @if(session('unMatch'))
        <small class="text-danger">{{ session('unMatch') }}</small>
    @endif

    <div>
        <label for="newPwd" class="form-label mt-3 fs-5">New Passsword:</label>
        <input type="password" class="form-control p-2 mt-2 @error('newPwd') is-invalid @enderror" id="newPwd"
            name="newPwd" placeholder="Enter New Passsword">
    </div>
    @error('newPwd')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="confirmPwd" class="form-label mt-3 fs-5">Confirm Passsword:</label>
        <input type="password" class="form-control p-2 mt-2 @error('confirmPwd') is-invalid @enderror" id="confirmPwd"
            name="confirmPwd" placeholder="Enter Password again to Confirm">
    </div>
    @error('confirmPwd')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="submit" value="Update Password" class="btn btn-danger rounded mt-4 mb-4 px-3 fs-5 col-12">
@endsection

@section('image')
    <img class="d-none d-lg-flex mt-0 mt-lg-5" src="{{ asset('img/changePassword.jpg') }}" style="width: 80%; object-fit:contain;" alt="">
@endsection
