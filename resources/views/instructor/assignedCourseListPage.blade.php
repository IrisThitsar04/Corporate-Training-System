@extends('layouts.InstructorCourseList')

@section('cardtitle','Assigned Courses')

@section('cardDesc','Choose one of the Assigned Courses to View Respective Assignments')

@section('image')
    <img src="{{ asset('img/Assigned Courses.webp') }}" style="width:80%; height:100%; object-fit:cover;" alt="">
@endsection
{{-- @section('breadcrumb')
    <div class="row">
        <div class="" id="breadcrumb">{!! Breadcrumbs::render('instructor.assignedCourses') !!}</div>
    </div>
@endsection --}}

@section('courseList')
        <div class="row " id="eventContainer">
            @foreach ($courses as $course)
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                 <a href="{{route('assignedCourseDetailsPage', $course['id'])}}" class="text-decoration-none">
                    <div class="card h-100">
                        @if ($course['course_profile']!=null)
                        <img src="{{asset('storage/'.$course['course_profile'])}}" alt="..." style="min-height:245px; max-height:250px; object-fit:cover;">
                        @else
                            <img src="{{asset('img/image_not_found.jpg')}}" style="min-height:245px; max-height:250px; object-fit:cover;" alt="">
                        @endif
                         <div class="card-body  text-muted">
                            <h4 class="card-title text-center mt-3 mb-5">{{$course['name']}}</h4>
                            <div class="card-text row">
                                <div class="col-6"><b>Starts : </b>{{$course['start_date']}}</div>
                                <div class="col-6"><b>Ends : </b>{{$course['end_date']}} </div>
                            </div>
                            <p class="card-text mt-3"><b>Duration: </b>{{$course['duration']}}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        {{$courses->links()}}
@endsection

