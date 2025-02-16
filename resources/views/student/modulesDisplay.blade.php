@extends('layouts.studentCourseList')

@section('cardtitle', $courseName . ' Course Modules')

@section('cardDesc', 'See the Modules your Enrolled Courses')

@section('image')
    <img src="{{ asset('img/upload_module.avif') }}" style="width:85%;  height:100%; object-fit:cover; object-position:right;"
        alt="">
@endsection
{{-- @section('breadcrumb')
    <div class="row">
        <div class="" id="breadcrumb">{!! Breadcrumbs::render('student.modules', $course_id, Auth::user()->id) !!}</div>
    </div>
@endsection --}}

@section('mailbox')
    <li class="nav-item mb-2">
        <a href={{route('studentMailBoxPage')}}
            class="nav-link text-decoration-none ms-3 ms-xl-4 fs-xl-5 fs-6">
            <i class="fa-solid fa-envelope me-2" style="color: rgb(11, 36, 92)"></i>
            <span style="color: rgb(11, 36, 92)">Mail Box</span>
        </a>
    </li>
@endsection

@section('courseList')
    <div class="row ">
        @foreach ($modules as $module)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a href="{{ route('lessonsDisplayPage', $module['id']) }}" class="text-decoration-none text-muted">
                    <div class="card h-100">
                        <div class="card-body text-center text-muted">
                            <h3 class="card-title mt-3 mb-4">{{ $module['name'] }}</h3>
                            <p class="card-text mb-4">{{ $module['description'] }}</p>
                            <a href="{{ route('lessonsDisplayPage', $module['id']) }}"
                                class="card-text text-decoration-none"> <small>View Lessons >>></small></a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
