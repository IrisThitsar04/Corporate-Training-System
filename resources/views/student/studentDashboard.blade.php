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

@section('content')
    <div class="container-fluid mt-5">
        {{-- Enrolled & Completed Courses Card Start --}}
                <div class="row d-flex justify-content-evenly my-5 px-3">
                    <a href="{{route('enrolledCoursesPage',Auth::user()->id)}}" class="card col-lg-5 col-md-5 col-12 p-3 ms-md-2 text-center shadow-sm text-decoration-none">
                        <span><img src="{{asset('img/enrolled courses.avif')}}" width="30%"></span>
                        <h4 class="mb-3" style="color: rgb(61, 17, 133)">Enrolled Courses</h4>
                        <h5 style="color: rgb(61, 17, 133)">Total- {{$totalCourses}} </h5>
                        <p class="mt-3" style="color: rgb(61, 17, 133)">See all Enrolled Courses<i class="fa-solid fa-arrow-right ms-1 fs-6 pt-2"></i></p>
                    </a>

                     <a href="{{route('completedCourseList')}}" class="card col-lg-5 col-md-5 col-12 p-3 ms-md-2 text-center shadow-sm text-decoration-none">
                        <span class="mt-4" ><img src="{{asset('img/completed_courses.jpg')}}" width="25%" style="border-radius: 50%"></span>
                        <h4 class="my-3" style="color: rgb(133, 100, 17)">Completed Courses</h4>
                        <h5 style="color: rgb(133, 100, 17)">Total- {{$completedCourses}}</h5>
                        <p class="mt-3" style="color: rgb(133, 100, 17)">See all Completed Courses <i class="fa-solid fa-arrow-right ms-1 fs-6 pt-2"></i></p>
                    </a>

                    {{-- Enrolled & Completed Courses Card End --}}

                    {{-- See Grades Card Start --}}
                    <div class="row my-5 d-flex justify-content-evenly">
                    <a href="{{route('chooseCourseforStudentProgress')}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{asset('img/progress2.jpg')}}" style="width: 90%" alt="">
                            </div>
                            <div class="col-8 px-5 d-block align-self-center" style="color: rgb(17, 75, 133)">
                                <h2 class="mb-4">Track your Progress!</h2>
                                <p> See your Grades and Completeion Percentage of your Enrolled Courses</p>
                                <span class="d-flex mt-4">
                                    <h5 class="mt-1">Click Here to View Progress</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
               {{-- See Grades Card End --}}

               {{-- See Assignments Start --}}
                    <div class="row d-flex justify-content-evenly mb-5">
                    <a href="{{route('assignmentPage',Auth::user()->id)}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-8 px-5 d-block align-self-center" style="color: rgb(100, 38, 161)">
                                <h2 class="mb-4">View Assignments!</h2>
                                <p> View all Upcoming, Past-Due and Completed Assignments</p>
                                <span class="d-flex mt-4">
                                    <h5 class="mt-1">Click Here to View Assignments</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                                </span>
                            </div>
                            <div class="col-4">
                                <img src="{{asset('img/assignment.jpg')}}" style="width: 100%" alt="">
                            </div>
                        </div>
                    </a>
                </div>
               {{-- See Assignments End --}}

               <div class="row d-flex justify-content-evenly mb-5">
                    <a href="{{route('submittedAssignmentPage')}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-8 px-5 d-block align-self-center" style="color: rgb(133, 56, 17)">
                                <h2 class="mb-4">View Submitted Assignments!</h2>
                                <p> View all Submitted Assignments</p>
                                <span class="d-flex mt-4">
                                    <h5 class="mt-1">Click Here to View Submitted Assignments</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                                </span>
                            </div>
                            <div class="col-4">
                                <img src="{{asset('img/upload_assignment2.jpg')}}" style="width: 100%" alt="">
                            </div>
                        </div>
                    </a>
                </div>

               <div class="row d-flex justify-content-evenly mb-5">
                    <a href="{{route('assignmentGradePage')}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-8 px-5 d-block align-self-center" style="color: rgb(17, 116, 133)">
                                <h2 class="mb-4">View Assignments Grade</h2>
                                <p> View Grades of your Submitted Assignments</p>
                                <span class="d-flex mt-4">
                                    <h5 class="mt-1">Click Here to View Assignments Grade</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                                </span>
                            </div>
                            <div class="col-4">
                                <img src="{{asset('img/upload_assignment2.avif')}}" style="width: 100%" alt="">
                            </div>
                        </div>
                    </a>
                </div>

               <div class="row mb-5 d-flex justify-content-evenly">
                    <a href="{{route('InstructorList')}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{asset('img/Assigned Courses.webp')}}" style="width: 100%" alt="">
                            </div>
                            <div class="col-8 px-5 d-block align-self-center" style="color: rgb(56, 72, 162)">
                                <h2 class="mb-4">View your Instructors!</h2>
                                <p>View your Instructors from your Enrolled Courses</p>
                                <span class="d-flex mt-4">
                                    <h5 class="mt-1">Click Here to View your Instructors</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Manage Profile Start --}}
                    <div class="row mb-5 d-flex justify-content-evenly">
                    <a href="{{route('studentManageProfilePage')}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{asset('img/manage_profile.avif')}}" style="width: 100%" alt="">
                            </div>
                            <div class="col-9 px-5 d-block align-self-center" style="color: rgb(133, 17, 133)">
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



                {{-- Total Card Start --}}
                {{-- <div class="row d-flex justify-content-evenly">
                    <a href="{{url('/login')}}" class="card col-lg-2 col-md-5 col-12 p-3 ms-md-2 text-center shadow-sm py-4 text-decoration-none">
                        <i class="fa-solid fa-book-open-reader mb-4 fs-2 text-primary"></i>
                        <h4>Total Courses</h4>
                        <h5>123324</h5>
                    </a>

                    <a href="" class="card col-lg-2 col-md-5 col-12 ms-md-2 p-3 text-center shadow-sm py-4 text-decoration-none">
                        <i class="fa-solid fa-chalkboard-user mb-4 fs-2 text-danger"></i>
                        <h4>Total Instructors</h4>
                        <h5>123324</h5>
                    </a>
                    <a href="" class="card col-lg-2 col-md-5 col-12 ms-md-2 mt-md-2 mt-lg-0 p-3 text-center shadow-sm py-4 text-decoration-none">
                        <i class="fa-solid fa-user-graduate mb-4 fs-2 text-success"></i>
                        <h4>Total Students</h4>
                        <h5>123324</h5>
                    </a>
                    <a href="" class="card col-lg-2 col-md-5 col-12 ms-md-2 mt-md-2 mt-lg-0 p-3 text-center shadow-sm py-4 text-decoration-none">
                        <i class="fa-solid fa-user-gear mb-4 fs-2 text-warning"></i>
                        <h4>Total Admins</h4>
                        <h5>123324</h5>
                    </a>
                </div> --}}
                {{-- Total Card End --}}

            </div>
@endsection

