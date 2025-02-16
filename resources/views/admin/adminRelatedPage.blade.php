@extends('layouts.layout')

@section('navCoursesRoute', route('courseRelatedPage'))
@section('navInstructorsRoute', route('instructorsRelatedPage'))
@section('navStudentsRoute', route('studentsRelatedPage'))
@section('navAdminRoute', route('adminRelatedPage'))
@section('navHomeRoute', route('user#dashboard'))
@section('navProfileRoute', route('manageProfilePage'))
@section('navEditProfileRoute', route('adminEditProfilePage'))

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif


@section('content')
    <div class="container-fluid mt-5">
        <div class="row my-5 d-flex justify-content-evenly">
            <a href="{{ route('registerPage') }}" class="card col-10 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-lg-4 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                        <img src="{{ asset('img/register.jpg') }}" style="width: 90%" alt="">
                    </div>
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center text-muted">
                        <h2 class="mb-4">Register Admins</h2>
                        <p> Register the Admins who will be using the System</p>
                        <span class="d-flex mt-4">
                            <h5 class="mt-1">Click Here to for Registeration</h5>
                            <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        <div class="row my-5 d-flex justify-content-evenly">
            <a href="{{ route('addAdminPage') }}" class="card col-10 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-6 offset-3 mb-3 d-lg-none">
                        <img src="{{asset('img/created_courses.avif')}}" style="width: 90%" alt="">
                    </div>
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center">
                        <h2 class="mb-4">Add Admins!</h2>
                        <p> Add Admins to Manage the System</p>
                        <span class="d-flex mt-4">
                            <h5 class="mt-1">Click Here to Add Admins</h5>
                            <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                        </span>
                    </div>
                    <div class="col-4 offset-4 offset-lg-0 mb-lg-0 mb-4 d-none d-lg-flex">
                        <img src="{{ asset('img/enroll_students.jpg') }}" style="width: 90%" alt="">
                    </div>
                </div>
            </a>
        </div>

        <div class="row my-5 d-flex justify-content-evenly">
            <a href="{{route('manageProfilePage')}}" class="card col-10 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-lg-4 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                        <img src="{{ asset('img/manage_profile.avif') }}" style="width: 70%" alt="">
                    </div>
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center">
                        <h3 class="mb-4">Manage Profile</h3>
                        <p> Edit your Profile or Change your Password</p>
                        <span class="d-flex mt-3">
                            <h5 class="">Click Here to Edit Profile or Change Password</h5>
                            <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                        </span>
                    </div>
                </div>
            </a>
    </div>
@endsection
