@extends('layouts.studentCourseList')

@section('cardtitle', 'Enrolled Courses')

@section('cardDesc', 'These are the Courses that you have been Enrollled')

@section('mailbox')
    <li class="nav-item mb-2">
        <a href={{route('studentMailBoxPage')}}
            class="nav-link text-decoration-none ms-3 ms-xl-4 fs-xl-5 fs-6">
            <i class="fa-solid fa-envelope me-2" style="color: rgb(11, 36, 92)"></i>
            <span style="color: rgb(11, 36, 92)">Mail Box</span>
        </a>
    </li>
@endsection

@section('image')
    <img src="{{ asset('img/enrolled courses.avif') }}" style="width:60%;  height:100%; object-fit:cover;" alt="">
@endsection
{{-- @section('breadcrumb')
    <div class="row">
        <div class="" id="breadcrumb">{!! Breadcrumbs::render('student.enrolledCourses', Auth::user()->id) !!}</div>
    </div>
@endsection --}}

@section('courseList')
    <div class="row ">
        @foreach ($courses as $course)
            <div class="col-12 col-md-6 col-lg-4 my-3">
                <a href="{{ route('modulesDisplayPage', $course['course_id']) }}" class="text-decoration-none text-muted">
                    <div class="card h-100">
                        <div class="card-body text-center text-muted">
                            <h3 class="card-title mt-3 mb-4">{{ $course['courseName'] }}</h3>
                            <p class="card-text mb-3">Enrolled at:
                                {{ \Carbon\Carbon::parse($course['enrolled_at'])->format('d-m-Y') }}</p>
                            <a href="{{ route('modulesDisplayPage', $course['course_id']) }}"
                                class="card-text text-decoration-none"> <small>View Course
                                    Details >>></small></a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
