@extends('layouts.studentCourseList')

@section('cardtitle', 'Lessons')

@section('cardDesc', 'See all the Lessons your Enrolled Courses!')

@section('image')
    <img src="{{ asset('img/create_lesson.avif') }}" style="width:85%; height:100%; object-fit:cover; object-position:left;"
        alt="">
@endsection
{{-- @section('breadcrumb')
    <div class="row mt-3">
        <div class="" id="breadcrumb">{!! Breadcrumbs::render('student.lessons', $course_id, Auth::user()->id, $module_id) !!}</div>
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
    <div class="row " id="eventContainer">
        @foreach ($lessons as $lesson)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a href="{{ route('individualLessonPage', ['id' => $lesson['id'], 'moduleId' => $lesson['module_id']]) }}"
                    class="text-decoration-none">
                    <div class="card h-100 py-3">
                        <div class="card-body text-center">
                            <h3 class="card-title mt-3 mb-4 text-muted">{{ $lesson['name'] }}</h3>
                            <a href="{{ route('individualLessonPage', ['id' => $lesson['id'], 'moduleId' => $lesson['module_id']]) }}"
                                class="card-text text-decoration-none"> <small>Lesson Materials <i
                                        class="fa-solid fa-arrow-right mt-1"></i></small> </a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
