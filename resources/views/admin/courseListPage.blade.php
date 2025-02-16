@extends('layouts.courseList')

@section('cardtitle','Created Courses')

@section('cardDesc','Here are all the Created courses')

@section('image')
    <img src="{{ asset('img/created_courses.avif') }}" style="width:68%; height:100%; object-fit:cover;" alt="">
@endsection

{{-- @section('breadcrumb')
    <div class="row">
        <div class="mt-3 mb-2" id="breadcrumb">{!! Breadcrumbs::render('admin.courses.list') !!}</div>
    </div>
@endsection --}}

@section('courseList')
        <div class="container mt-5">
        <div class="row" id="eventContainer">

            @foreach ($courses as $course)
                <div class="col-12 col-md-6 col-lg-4 mt-1 mb-3">
                <div class="card h-100">
                    @if ($course['course_profile']!=null)
                        <img src="{{asset('storage/'.$course['course_profile'])}}" alt="..." style="min-height:245px; max-height:250px; object-fit:cover;">
                    @else
                        <img src="{{asset('img/image_not_found.jpg')}}" style="min-height:245px; max-height:250px; object-fit:cover;" alt="">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title text-center mt-3 mb-5">{{$course['name']}}</h4>
                        <div class="card-text row">
                            <div class="col-6"><b>Starts : </b>{{$course['start_date']}}</div>
                            <div class="col-6"><b>Ends : </b>{{$course['end_date']}} </div>
                        </div>
                        <p class="card-text mt-3"><b>Duration: </b>{{$course['duration']}}</p>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-evenly">
                        <a href="{{route('editCoursePage',$course['id'])}}" class="col-6 text-primary text-center text-decoration-none"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                        <a href="{{route('delete#course',$course['id'])}}" class="col-6 text-danger text-center text-decoration-none"><i class="fa-solid fa-trash"></i>Delete</a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
        {{ $courses->links() }}
    </div>
@endsection
