@extends('layouts.layout')

@section('navCoursesRoute', route('courseRelatedPage'))
@section('navInstructorsRoute', route('instructorsRelatedPage'))
@section('navStudentsRoute', route('studentsRelatedPage'))
@section('navAdminRoute', route('adminRelatedPage'))
@section('navHomeRoute', route('user#dashboard'))
@section('navProfileRoute', route('manageProfilePage'))
@section('navEditProfileRoute', route('adminEditProfilePage'))

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif


@section('content')
<div class="container" id="loginContainer">
        <div class="row mt-5 d-flex justify-content-center mb-5">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="mb-2">
                                <a href="{{route('courseListPage')}}" class="fs-6 text-decoration-none text-black">
                                    <i class="fa-solid fa-arrow-left mt-1 me-1"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card h-100">
                    <div class="d-flex justify-content-center mt-2">
                        @if ($data['course_profile']!=null)
                            <img src="{{asset('storage/'.$data['course_profile'])}}" style="width: 100%; height:250px; object-fit:cover;" alt="">
                        @else
                            <img src="{{asset('img/image_not_found.jpg')}}" style="width: 100%; height:250px; object-fit:cover;" alt="">
                        @endif
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center mt-3 mb-5">Name: {{$data['name']}}</h4>
                        <p class="card-text"><b>Description : </b>{{$data['description']}} </p>
                        <p class="card-text"><b>Instructor : </b>{{$data['instructor_name']}} </p>
                        <p class="card-text"><b>Start Date : </b>{{$data['start_date']}} </p>
                        <p class="card-text"><b>End Date : </b>{{$data['end_date']}} </p>
                        <p class="card-text mt-3"><b>Duration: </b>{{$data['duration']}}</p>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-evenly mt-3">
                        <a href="{{route('updateCoursePage',$data['id'])}}" class="col-6 text-primary text-center text-decoration-none"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
                        <a href="" class="col-6 text-danger text-center text-decoration-none"><i class="fa-solid fa-trash me-2"></i>Delete</a>
                    </div>

                </div>

                        </div>

@endsection
