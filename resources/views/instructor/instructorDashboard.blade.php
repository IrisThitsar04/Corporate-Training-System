@extends('layouts.instructorLayout')

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif

@section('content')
    <div class="container-fluid d-flex justify-content-evenly">

                {{-- Enrolled & Completed Courses Card Start --}}
            <div class="row d-flex justify-content-evenly my-5 px-3">
                    <a href="{{route('assignedCourseListPage')}}" class="card col-lg-5 col-md-5 col-12 p-3 ms-md-2 text-center shadow-sm text-decoration-none">
                        <span><img src="{{asset('img/enrolled courses.avif')}}" width="30%"></span>
                        <div  style="color: rgb(86, 35, 159)">
                            <h4 class="mb-3">Total Assigned Courses</h4>
                            <h5>Total- {{ $totalCourses }} </h5>
                        </div>
                    </a>

                     <a href="{{route('enrolledStudentListPage')}}" class="card col-lg-5 col-md-5 col-12 p-3 ms-md-2 text-center shadow-sm text-decoration-none">
                        <span class="mt-4" ><img src="{{asset('img/completed_courses.jpg')}}" width="25%" style="border-radius: 50%"></span>
                        <div style="color: rgb(159, 114, 35)">
                            <h4 class="my-3">Total Students</h4>
                            <h5>Total- {{$totalStudents}} </h5>
                        </div>
                    </a>

                    {{-- Enrolled & Completed Courses Card End --}}

                     {{-- Assigned Courses Start --}}
                    <div class="row my-5 d-flex justify-content-evenly">
                    <a href="{{route('assignedCourseListPage')}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-lg-4 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                                <img src="{{asset('img/Assigned Courses.webp')}}" style="width: 100%" alt="">
                            </div>
                            <div class="col-lg-8 col-12 px-5 d-block align-self-center"  style="color: rgb(62, 58, 146)">
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


               {{-- See Enrolled Start --}}
                    <div class="row d-flex justify-content-evenly mb-5">
                    <a href="" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-6 offset-3 mb-3 d-lg-none">
                                <img src="{{asset('img/assignment.jpg')}}" style="width: 100%" alt="">
                            </div>
                            <div class="col-lg-8 col-12 px-5 d-block align-self-center"  style="color: rgb(137, 67, 177)">
                                <h2 class="mb-4">Enrolled Students</h2>
                                <p> View all Students Respective to the Enrolled Courses</p>
                                <span class="d-flex mt-4">
                                    <h5 class="mt-1">Click Here to View Enrolled Students</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                                </span>
                            </div>
                            <div class="col-4 offset-4 offset-lg-0 mb-lg-0 mb-4 d-none d-lg-flex">
                                <img src="{{asset('img/assignment.jpg')}}" style="width: 100%" alt="">
                            </div>
                        </div>
                    </a>
                </div>
               {{-- See Enrolled End --}}

               {{-- Total Card Start --}}
                <div class="row d-flex justify-content-evenly mb-5">
                    <a href="{{route('chooseCourseforModule')}}" class="card col-lg-3 col-md-3 col-12 p-3 text-center shadow-sm py-5 text-decoration-none">
                        <span><img src="{{asset('img/upload_module.avif')}}" width="40%" class="mb-3"></span>
                        <div>
                            <h4 class="mb-3">Upload Module</h4>
                            <h6>Click Here to Upload a Module</h6>
                        </div>
                    </a>

                    <a href="{{route('chooseCourseforLesson')}}" class="card col-lg-3 col-md-3 col-12 p-3 text-center shadow-sm py-5 text-decoration-none">
                        <span><img src="{{asset('img/create_lesson.avif')}}" width="40%" class="mb-3"></span>
                        <div style="color: rgb(139, 138, 27)">
                            <h4 class="mb-3">Upload Lesson</h4>
                            <h6>Click Here to Upload a Lesson</h6>
                        </div>
                    </a>

                    <a href="{{route('chooseCourseforAssignment')}}" class="card col-lg-3 col-md-3 col-12 p-3 text-center shadow-sm py-5 text-decoration-none">
                        <span><img src="{{asset('img/upload_assignment.svg')}}" width="30%" class="mb-3"></span>
                        <div style="color: rgb(48, 35, 161)">
                            <h4 class="mb-3">Upload Assignment</h4>
                            <h6>Click Here to Upload an Assignment</h6>
                        </div>
                    </a>
                </div>
                {{-- Total Card End --}}

                {{-- Uploaded Assignments Start --}}
                    <div class="row mb-5 d-flex justify-content-evenly">
                    <a href="{{route('chooseCourse_Assignment',Auth::user()->id)}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-lg-3 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                                <img src="{{asset('img/upload_assignment2.jpg')}}" style="width: 100%" alt="">
                            </div>
                            <div class="col-lg-9 col-12 px-5 d-block align-self-center" style="color: rgb(109, 67, 177)">
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
                    <a href="{{route('chooseCourseforSubmissions')}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-8 px-5 d-block align-self-center" style="color: rgb(60, 120, 168)">
                                <h2 class="mb-4">View Submitted Assignments!</h2>
                                <p> View Submitted Assignments by Students</p>
                                <span class="d-flex mt-4">
                                    <h5 class="mt-1">Click Here to View Submitted Assignments</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                                </span>
                            </div>
                            <div class="col-4">
                                <img src="{{asset('img/upload_assignment2.avif')}}" style="width: 100%" alt="">
                            </div>
                        </div>
                    </a>
                </div>
               {{-- See Submitted Assignments End --}}

               <div class="row d-flex justify-content-evenly mb-5">
                    <a href="{{route('chooseCourseforGrades')}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-9 px-5 d-block align-self-center" style="color: rgb(31, 96, 129)">
                                <h2 class="mb-4">View Assignment Grades</h2>
                                <p>View Assignment Grades of Enrolled Students</p>
                                <span class="d-flex mt-4">
                                    <h5 class="mt-1">Click Here to View Assignment Grades</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                                </span>
                            </div>
                            <div class="col-3">
                                <img src="{{asset('img/progress2.jpg')}}" style="width: 100%" alt="">
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Course Completion Percentage Start --}}
                    <div class="row mb-5 d-flex justify-content-evenly">
                    <a href="{{route('chooseCourseforProgressPage')}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-lg-3 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                                <img src="{{asset('img/completed_courses2.jpg')}}" style="width: 100%" alt="">
                            </div>
                            <div class="col-lg-9 col-12 px-5 d-block align-self-center" style="color: rgb(151, 144, 54)">
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

                {{-- Manage Profile Start --}}
                    <div class="row mb-5 d-flex justify-content-evenly">
                    <a href="{{route('instructorManageProfilePage')}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-lg-3 col-6 offset-3 offset-lg-0 mb-lg-0 mb-3">
                                <img src="{{asset('img/manage_profile.avif')}}" style="width: 100%" alt="">
                            </div>
                            <div class="col-lg-9 col-12 px-5 d-block align-self-center" style="color: rgb(125, 32, 122)">
                                <h2 class="mb-4">Manage your Profile!</h2>
                                <p>Edit and Modify your Profile</p>
                                <span class="d-flex mt-4">
                                    <h5 class="mt-1">Click Here to Manage your Profile</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
               {{-- Manage Profile End --}}

            </div>
    </div>
@endsection

