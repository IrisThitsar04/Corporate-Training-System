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
                        <h2 class="mb-4">Register Students</h2>
                        <p> Register the Students who will be using the System</p>
                        <span class="d-flex mt-4">
                            <h5 class="mt-1">Click Here to for Registeration</h5>
                            <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        <div class="row my-5 d-flex justify-content-evenly">
            <a href="{{ route('enrollStudentsPage') }}" class="card col-10 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-6 offset-3 mb-3 d-lg-none">
                        <img src="{{ asset('img/enroll_students.jpg') }}" style="width: 90%" alt="">
                    </div>
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center">
                        <h2 class="mb-4">Enroll Students!</h2>
                        <p> Enroll the Registered Students to the Respective Courses</p>
                        <span class="d-flex mt-4">
                            <h5 class="mt-1">Click Here to Enroll Students</h5>
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
            <a href="{{ route('chooseCourseforProgress') }}" class="card col-10 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-lg-4 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                        <img src="{{ asset('img/completed_courses2.jpg') }}" style="width: 80%" alt="">
                    </div>
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center text-muted">
                        <h3 class="mb-4">View Completed Courses by Students</h3>
                        <p> Students who have completed the respective courses will be given certificates.</p>
                        <span class="d-flex mt-3">
                            <h5 class="">Click Here to View Students</h5>
                            <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
