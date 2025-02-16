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
                    <div class="card col-lg-10 col-12">
                        <div class="row">
                            <div class="d-flex justify-content-center mt-5">
                                         <img src="{{asset('img/logo1.jpeg')}}" style="width: 8%" alt="">
                                    </div>

                                    <h2 class="text-center mt-2">Admin Role Update Form</h2>
                                    <small class="text-center">Only the Registered Users can be Updated to  Admin Role</small>
                        </div>
                        <div class="row">
                            <div class="col-lg-7 col-12">
                                <form class="container-fluid" action="{{route('addAdmin')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-sm-9 col-md-8 col-lg-12 pt-4 px-5 rounded-3 bg-white">
                            <div>
                                <label for="name" class="form-label mt-4 fs-5">Name:</label>
                                <input type="text" class="form-control p-2 mt-2 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name of the User"  value="{{old('name')}}">
                            </div>
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="role" class="form-label mt-4 fs-5">Role:</label>
                                <input type="text" value="admin" class="form-control p-2 mt-2 @error('role') is-invalid @enderror" id="role" name="role" placeholder="Enter Course Name" readonly>
                            </div>

                            <input type="submit" value="Update Role to Admin" class="btn btn-danger rounded mt-4 mb-5 px-3 fs-5 col-12">
                        </div>
                    </div>

                </form>
                            </div>
                            <div class="col-lg-5 col-md-4">
                                <img class="d-none d-lg-flex mt-0 mt-lg-5" src="{{asset('img/enrolled courses.avif')}}" style="width: 80%; object-fit:contain" alt="">
                            </div>
                        </div>
                    </div>
    </div>
@endsection
