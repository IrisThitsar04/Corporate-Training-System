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
            <a href="{{ route('chooseCourseforProgress') }}" class="card col-10 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-lg-4 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                        <img src="{{ asset('img/Assigned Courses.webp') }}" style="width: 80%" alt="">
                    </div>
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center text-muted">
                        <h3 class="mb-4">Create Courses</h3>
                        <p> Create Courses Here!</p>
                        <span class="d-flex mt-3">
                            <h5 class="">Click Here to Create Courses</h5>
                            <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        <div class="row my-5 d-flex justify-content-evenly">
            <a href="{{ route('courseListPage') }}" class="card col-10 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-lg-4 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                        <img src="{{ asset('img/created_courses.avif') }}" style="width: 80%" alt="">
                    </div>
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center text-muted">
                        <h3 class="mb-4">View Created Courses</h3>
                        <p> View all the Courses that have been Created</p>
                        <span class="d-flex mt-3">
                            <h5 class="">Click Here to View Created Courses</h5>
                            <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                        </span>
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
