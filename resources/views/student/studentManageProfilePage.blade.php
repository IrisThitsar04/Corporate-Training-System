@extends('layouts.studentLayout')

@section('mailbox')
    <li class="nav-item mb-2">
        <a href={{route('studentMailBoxPage')}}
            class="nav-link text-decoration-none ms-3 ms-xl-4 fs-xl-5 fs-6">
            <i class="fa-solid fa-envelope me-2" style="color: rgb(11, 36, 92)"></i>
            <span style="color: rgb(11, 36, 92)">Mail Box</span>
        </a>
    </li>
@endsection

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif

@section('content')
    <div class="row my-5 d-flex justify-content-evenly">
        <a href="" class="card col-10 px-5 py-4 text-decoration-none">
            <div class="row">
                <div class="col-12 px-5 text-muted">
                    <h3 class="mt-3 mb-5 text-center">My Profile</h3>
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-3 mt-5">
                                <div class="col-4">First Name:</div>
                                <div class="col-8">{{ $userData['first_name'] }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">Last Name:</div>
                                <div class="col-8">{{ $userData['last_name'] }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">Username: </div>
                                <div class="col-8">{{ $userData['username'] }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">Email:</div>
                                <div class="col-8">{{ $userData['email'] }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">User Role:</div>
                                <div class="col-8">{{ $userData['role'] }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            {{-- <img src="{{ asset('storage/' . $userData['profile_picture']) }}" alt=""> --}}
                            <img src="{{ asset('storage/' . $userData['profile_picture']) }}" alt=""
                                style="width: 70%">
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="row my-4 d-flex justify-content-evenly">
        <a href="{{ route('studentEditProfilePage') }}" class="card col-10 px-5 py-4 text-decoration-none">
            <div class="row">
                <div class="col-12 px-5 text-muted">
                    <h3 class="my-2">Edit Profile</h3>
                    <p>Click to Edit your Profile </p>
                </div>
            </div>
        </a>
    </div>

    <div class="row my-4 d-flex justify-content-evenly">
        <a href="{{route('studentChangePasswordPage')}}" class="card col-10 px-5 py-4 text-decoration-none">
            <div class="row">
                <div class="col-12 px-5 text-muted">
                    <h3 class="my-2">Change Password</h3>
                    <p>Click to Change Password</p>
                </div>
            </div>
        </a>
    </div>
@endsection
