@extends('layouts.studentCourseList')

@section('cardtitle', 'Assignments')

@section('cardDesc', 'See all the Uploaded Assignments!')

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
    <img src="{{ asset('img/create_lesson.avif') }}" style="width:85%; height:100%; object-fit:cover; object-position:left;"
        alt="">
@endsection
{{-- @section('breadcrumb')
    <div class="row mt-3">
        <div class="" id="breadcrumb">{!! Breadcrumbs::render('student.lessons', $course_id, Auth::user()->id, $module_id) !!}</div>
    </div>
@endsection --}}

@section('courseList')
    <div class="row " id="eventContainer">
        @foreach ($data as $assignment)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a href="" class="text-decoration-none">
                    <div class="card h-100 py-3">
                        <div class="card-body">
                            <h3 class="card-title mt-3 mb-4 text-center text-muted">{{ $assignment['title'] }}</h3>
                            <p class="card-text text-muted">Due:{{ $assignment['due'] }}</p>
                            <p class="card-text text-muted">Max Score:{{ $assignment['max_score'] }}</p>
                            <div class="mt-4 text-center">
                                <a href="{{route('detailedAssignmentPage', $assignment['id']) }}" class="card-text text-decoration-none text-center">
                                <b>View Assignment <i class="fa-solid fa-arrow-right mt-1"></i></b>
                            </a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    {{$data->links()}}
@endsection
