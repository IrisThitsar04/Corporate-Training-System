@extends('layouts.instructorLayout')

@if ($navProfile != null)
    @section('navProfile', asset('storage/' . $navProfile))
@else
    @section('navProfile', asset('img/profile_not_found.webp'))
@endif

@section('content')
    <div class="container-fluid ">
        {{-- Assigned Courses Start --}}
        <div class="row my-5 d-flex justify-content-evenly">
            <a href="{{ route('assignedCourseListPage') }}" class="card col-11 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-lg-4 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                        <img src="{{ asset('img/Assigned Courses.webp') }}" style="width: 100%" alt="">
                    </div>
                    <div class="col-lg-8 col-12 px-5 d-block align-self-center">
                        <h2 class="mb-4">Assigned Courses</h2>
                        <p> See all the Courses that are Assigned to you!</p>
                        <span class="d-flex mt-4">
                            <h5 class="mt-1">Click Here to View your Assigned Courses</h5>
                            <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>
        {{-- Assigned Courses End --}}

        {{-- Course Completion Percentage Start --}}
        <div class="row mb-5 d-flex justify-content-evenly">
            <a href="{{route('chooseCourseforProgressPage')}}" class="card col-11 px-5 py-4 text-decoration-none">
                <div class="row">
                    <div class="col-lg-3 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                        <img src="{{ asset('img/completed_courses2.jpg') }}" style="width: 100%" alt="">
                    </div>
                    <div class="col-lg-9 col-12 px-5 d-block align-self-center">
                        <h2 class="mb-4">Track Course Completion Percentage</h2>
                        <p>View Course Completion Percentage of Enrolled Students</p>
                        <span class="d-flex mt-4">
                            <h5 class="mt-1">Click Here to Course Completion Percentage</h5>
                            <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>
        {{-- Course Completion Percentage End --}}
    </div>
@endsection
