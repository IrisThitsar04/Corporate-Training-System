@extends('layouts.instructorCourseDetailsPage')

{{-- @section('back_url', route('assignedCourseListPage')) --}}

{{-- @section('breadcrumb')
    <div class="row">
        <div class="" id="breadcrumb">{!! Breadcrumbs::render('instructor.assignedCourseDetails', $id) !!}</div>
    </div>
@endsection --}}

@section('image')
    @if ($course['course_profile'] != null)
        <img src="{{asset('storage/'.$course['course_profile'])}}" style="width: 100%; height:250px; object-fit:cover;" alt="">
    @else
        <img src="{{asset('img/image_not_found.jpg')}}" style="width: 100%; height:250px; object-fit:cover;" alt="">
    @endif
@endsection

@section('name', $course["name"])

@section('description', $course["description"])

@section('instructor_name', $course["instructor_name"])

@section('start_date', $course["start_date"])

@section('end_date', $course["end_date"])

@section('duration', $course["duration"])

@section('footer')
    <div class="card-footer bg-white d-flex justify-content-center">
        <a href="{{ route('uploadedModulesPage', $course['id']) }}" class="text-decoration-none" style="color: rgb(38, 98, 154)"><i class="fa-solid fa-book me-2"></i><b>View Uploaded Modules and Lessons</b></a>
    </div>
@endsection
