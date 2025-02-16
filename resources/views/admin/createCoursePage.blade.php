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
                    <div class="card col-lg-10 col-md-12">
                        <div class="row">
                            <div class="d-flex justify-content-center mt-5">
                                         <img src="{{asset('img/logo1.jpeg')}}" style="width: 8%" alt="">
                                    </div>

                                    <h2 class="text-center mt-2">Course Creation Form</h2>
                                    {{-- <p class="text-center">Fill the Details of the Course Here!</p> --}}
                        </div>
                        <div class="row">
                            <div class="col-lg-7 col-12">
                                <form class="container-fluid" action="{{route('create#course')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-sm-9 col-md-8 col-lg-12 pt-4 px-5 rounded-3 bg-white">
                            <div>
                                <label for="courseName" class="form-label mt-4 fs-5">Course Name:</label>
                                <input type="text" class="form-control p-2 mt-2 @error('courseName') is-invalid @enderror" id="courseName" name="courseName" placeholder="Enter Course Name"  value="{{old('courseName')}}">
                            </div>
                            @error('courseName')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="description" class="form-label mt-4 fs-5">Course Description:</label>
                                <input type="text" class="form-control p-2 mt-2 @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter Course Name"  value="{{old('description')}}">
                            </div>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="instructor_name" class="form-label mt-4 fs-5">Instructor Name:</label>
                                <input type="text" class="form-control p-2 mt-2 @error('instructor_name') is-invalid @enderror" id="instructor_name" name="instructor_name" placeholder="Enter Course Name"  value="{{old('instructor_name')}}">
                            </div>
                            @error('instructor_name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="start_date" class="form-label mt-4 fs-5">Start Date:</label>
                                <input type="date" class="form-control p-2 mt-2 @error('start_date') is-invalid @enderror" id="start_date" name="start_date" placeholder="Enter Course Name"  value="{{old('start_date')}}">
                            </div>
                            @error('start_date')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="end_date" class="form-label mt-4 fs-5">End Date:</label>
                                <input type="date" class="form-control p-2 mt-2 @error('end_date') is-invalid @enderror" id="end_date" name="end_date" placeholder="Enter Course Name"  value="{{old('end_date')}}">
                            </div>
                            @error('end_date')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="duration" class="form-label mt-4 fs-5">Duration:</label>
                                <input type="text" class="form-control p-2 mt-2 @error('duration') is-invalid @enderror" id="duration" name="duration" placeholder="Enter Course Name"  value="{{old('duration')}}">
                            </div>
                            @error('duration')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="course_profile" class="form-label mt-4 fs-5">Course Profile:</label>
                                <input type="file" class="form-control p-2 mt-2 @error('course_profile') is-invalid @enderror" id="course_profile" name="course_profile">
                            </div>
                            @error('course_profile')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <input type="submit" value="Create Course" class="btn btn-danger rounded mt-4 mb-5 px-3 fs-5 col-12">
                        </div>
                    </div>

                </form>
                            </div>
                            <div class="col-lg-5">
                                <img class="d-none d-lg-flex mt-0 mt-lg-5" src="{{asset('img/course_create.jpg')}}" style="width: 100%; height:100%; object-fit:contain" alt="">
                            </div>
                        </div>
                    </div>
    </div>
@endsection
