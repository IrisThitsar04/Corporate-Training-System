@extends('layouts.instructorLayout')

@if ($navProfile != null)
    @section('navProfile', asset('storage/' . $navProfile))
@else
    @section('navProfile', asset('img/profile_not_found.webp'))
@endif

@section('content')
    <div class="container-fluid d-flex justify-content-evenly">
        <div class="row d-flex justify-content-evenly my-5 px-3">

            <div class="row mb-5 d-flex justify-content-evenly">
                <a href="{{route('chooseCourseforAssignment')}}"
                    class="card col-11 px-5 py-4 text-decoration-none">
                    <div class="row">
                        <div class="col-lg-3 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                            <img src="{{asset('img/upload_assignment.svg')}}" style="width: 85%" alt="">
                        </div>
                        <div class="col-lg-9 col-12 px-5 d-block align-self-center">
                            <h2 class="mb-4">Upload Assignment</h2>
                            <p>Upload Assignment Here</p>
                            <span class="d-flex mt-4">
                                <h5 class="mt-1">Click Here to Upload Assignment</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            {{-- Uploaded Assignments Start --}}
            <div class="row mb-5 d-flex justify-content-evenly">
                <a href="{{ route('chooseCourse_Assignment', Auth::user()->id) }}"
                    class="card col-11 px-5 py-4 text-decoration-none">
                    <div class="row">
                        <div class="col-lg-3 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                            <img src="{{ asset('img/upload_assignment2.jpg') }}" style="width: 100%" alt="">
                        </div>
                        <div class="col-lg-9 col-12 px-5 d-block align-self-center">
                            <h2 class="mb-4">See all Uploaded Assignments</h2>
                            <p>View and Modify the Uploaded Assignments</p>
                            <span class="d-flex mt-4">
                                <h5 class="mt-1">Click Here to View Uploaded Assignments</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            {{-- Uploaded Assignments End --}}

            {{-- See Submitted Assignments Start --}}
            <div class="row d-flex justify-content-evenly mb-5">
                <a href="{{ route('chooseCourseforSubmissions') }}" class="card col-11 px-5 py-4 text-decoration-none">
                    <div class="row">
                        <div class="col-8 px-5 d-block align-self-center">
                            <h2 class="mb-4">View Submitted Assignments!</h2>
                            <p> View Submitted Assignments by Students</p>
                            <span class="d-flex mt-4">
                                <h5 class="mt-1">Click Here to View Submitted Assignments</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                            </span>
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('img/upload_assignment2.avif') }}" style="width: 100%" alt="">
                        </div>
                    </div>
                </a>
            </div>
            {{-- See Submitted Assignments End --}}

            <div class="row d-flex justify-content-evenly mb-5">
                <a href="{{ route('chooseCourseforGrades') }}" class="card col-11 px-5 py-4 text-decoration-none">
                    <div class="row">
                        <div class="col-9 px-5 d-block align-self-center">
                            <h2 class="mb-4">View Assignment Grades</h2>
                            <p>View Assignment Grades of Enrolled Students</p>
                            <span class="d-flex mt-4">
                                <h5 class="mt-1">Click Here to View Assignment Grades</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                            </span>
                        </div>
                        <div class="col-3">
                            <img src="{{ asset('img/progress2.jpg') }}" style="width: 100%" alt="">
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
