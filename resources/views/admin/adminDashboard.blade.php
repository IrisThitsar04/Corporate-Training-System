@extends('layouts.layout')

@section('style')
    <style>
        .card {
            transition: scale 0.8s;
        }

        .card:hover {
            scale: 1.05;
        }
    </style>
@endsection

@section('navCoursesRoute', route('courseRelatedPage'))
@section('navInstructorsRoute', route('instructorsRelatedPage'))
@section('navStudentsRoute', route('studentsRelatedPage'))
@section('navAdminRoute', route('adminRelatedPage'))
@section('navHomeRoute', route('user#dashboard'))
@section('navProfileRoute', route('manageProfilePage'))
@section('navEditProfileRoute', route('adminEditProfilePage'))

@if ($navProfile != null)
    @section('navProfile', asset('storage/' . $navProfile))
@else
    @section('navProfile', asset('img/profile_not_found.webp'))
@endif

@section('content')
    <div class="container-fluid mt-5">
        {{-- Total Card Start --}}
        <div class="row d-flex justify-content-evenly">
            <a href="{{ route('courseRelatedPage') }}"
                class="card col-lg-2 col-md-5 col-12 p-3 ms-md-2 text-center shadow-sm py-4 text-decoration-none"
                style="color:rgb(203, 113, 95)">
                <img src="{{ asset('img/enrollStudents.jpg') }}" width="50%" class="mb-3 mx-auto" alt="">
                <h4>Courses</h4>
                <h5>Total- {{ $totalCourses }}</h5>
            </a>

            <a href="{{ route('instructorList') }}"
                class="card col-lg-2 col-md-5 col-12 ms-md-2 p-3 text-center shadow-sm py-4 text-decoration-none"
                style="color:rgb(87, 93, 200)">
                <img src="{{ asset('img/Assigned Courses.webp') }}" width="50%" class="mb-3 mx-auto" alt="">
                <h4>Instructors</h4>
                <h5>Total- {{ $totalInstructors }}</h5>
            </a>
            <a href="{{ route('studentList') }}"
                class="card col-lg-2 col-md-5 col-12 ms-md-2 mt-md-2 mt-lg-0 p-3 text-center shadow-sm py-4 text-decoration-none"
                style="color:rgb(163, 139, 43)">
                <img src="{{ asset('img/completed_courses2.jpg') }}" width="50%" class="mb-3 mx-auto" alt="">
                <h4>Students</h4>
                <h5>Total- {{ $totalStudents }}</h5>
            </a>
            <a href="{{route('adminList')}}"
                class="card col-lg-2 col-md-5 col-12 ms-md-2 mt-md-2 mt-lg-0 p-3 text-center shadow-sm py-4 text-decoration-none"
                style="color:blueviolet">
                <img src="{{ asset('img/edit_course.avif') }}" width="40%" class="mb-3 mx-auto" alt="">
                <h4>Admins</h4>
                <h5>Total- {{ $totalAdmins }}</h5>
            </a>
        </div>
        {{-- Total Card End --}}

        <div class="row my-5 d-flex justify-content-evenly">
            <a href="{{ route('registerPage') }}" class="card col-10 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-lg-4 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                        <img src="{{ asset('img/register.jpg') }}" style="width: 90%" alt="">
                    </div>
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center" style="color:rgb(35, 139, 157)">
                        <h2 class="mb-4">Register Here!</h2>
                        <p> Register Instructors and Students who will be using the System</p>
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
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center" style="color:rgb(25, 136, 112)">
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
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center" style="color:rgb(163, 139, 43)">
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

        {{-- Functions Card Start --}}
        <div class="container px-md-5 px-0">
            <div class="row d-flex justify-content-evenly my-5 px-md-5 px-4">
                <div class="col-md-6 col-12 my-4 my-md-0">
                    <a href="{{ route('create#coursePage') }}" class="card p-3 text-center shadow-sm text-decoration-none"
                        style="color:rgb(127, 114, 55)">
                        <span class="mt-3">
                            <img src="{{ asset('img/course_create.jpg') }}" width="14%" alt="">
                        </span>
                        <h4 class="mb-3">Create Courses</h4>
                        <p>Click to Create Courses</p>
                    </a>
                </div>
                <div class="col-md-6 col-12 my-4 my-md-0">
                    <a href="{{ route('registerPage') }}" class="card p-3 text-center shadow-sm text-decoration-none"
                        style="color:rgb(167, 118, 158)">
                        <span class="mt-3">
                            <img src="{{ asset('img/courses.avif') }}" width="20%" class="mb-3" alt="">
                        </span>
                        <h4 class="mb-3">Register Instructors</h4>
                        <p>Click to Register Instructors</p>
                    </a>
                </div>
                <div class="col-md-6 col-12 my-4 my-md-0">
                    <a href="{{ route('registerPage') }}"
                        class="card mt-md-2 mt-lg-4 p-3 text-center shadow-sm text-decoration-none"
                        style="color:rgb(25, 136, 112)">
                        <span class="mt-3">
                            <img src="{{ asset('img/enroll_students.jpg') }}" width="20%" class="mb-3"
                                alt="">
                        </span>
                        <h4 class="mb-3">Register Students</h4>
                        <p>Click to Register Students</p>
                    </a>
                </div>
                <div class="col-md-6 col-12 my-4 my-md-0">
                    <a href="{{ route('addAdminPage') }}"
                        class="card mt-md-2 mt-lg-4 p-3 text-center shadow-sm text-decoration-none"
                        style="color:rgb(81, 94, 189)">
                        <span class="mt-3">
                            <img src="{{ asset('img/created_courses.avif') }}" width="20%" class="mb-2"
                                alt="">
                        </span>
                        <h4 class="mb-3">Add Admins</h4>
                        <p>Click to Add Admins</p>
                    </a>
                </div>
            </div>
        </div>
        {{-- Functions Card End --}}

        <div class="row my-5 d-flex justify-content-evenly">
            <a href="{{ route('courseListPage') }}" class="card col-10 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-lg-4 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                        <img src="{{ asset('img/created_courses.avif') }}" style="width: 80%" alt="">
                    </div>
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center" style="color:rgb(81, 94, 189)">
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
            <a href="{{ route('manageProfilePage') }}" class="card col-10 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-lg-4 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                        <img src="{{ asset('img/manage_profile.avif') }}" style="width: 70%" alt="">
                    </div>
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center" style="color:rgb(120, 27, 129)">
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
    </div>
@endsection
