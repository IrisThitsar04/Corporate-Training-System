@extends('layouts.studentCourseList')

{{-- @section('breadcrumb')
    <div class="row">
        <div class="mt-3 mb-2" id="breadcrumb">{!! Breadcrumbs::render('admin.chooseCourse')!!}</div>
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

@section('cardtitle','Choose Course First!')

@section('cardDesc','Choose one of the Courses to View the Course Completeion Percentage of the Enrolled Students')

@section('image')
    <img src="{{ asset('img/courses.avif') }}" style="width:80%; height:100%; object-fit:cover;" alt="">
@endsection


@section('courseList')
        <div class="row" id="eventContainer">
            @foreach ($courses as $course)
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                 <a href="{{route('trackStudentCompletedCourses', $course['id'])}}" class="text-decoration-none">
                    <div class="card h-100">
                        @if ($course['course_profile']!=null)
                        <img src="{{asset('storage/'.$course['course_profile'])}}" alt="..." style="min-height:245px; max-height:250px; object-fit:cover;">
                        @else
                            <img src="{{asset('img/image_not_found.jpg')}}" style="min-height:245px; max-height:250px; object-fit:cover;" alt="">
                        @endif
                         <div class="card-body  text-muted">
                            <h4 class="card-title text-center mt-3 ">{{$course['name']}}</h4>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            {{ $courses->links() }}
        </div>

@endsection

