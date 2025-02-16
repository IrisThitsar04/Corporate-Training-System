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

            <div class="row justify-content-center">

                <form class="container-fluid my-5" action="{{route('user#register')}}" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-sm-9 col-md-8 col-lg-5 pt-4 rounded-3 bg-white shadow-sm">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:history.back()" style="color:var(--theme)" class="fs-6 text-decoration-none">
                                        <i class="fa-solid fa-arrow-left mt-1 ms-2"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <img src="{{asset('img/logo1.jpeg')}}" alt="" style="width: 15%" class="mt-3">
                            </div>
                            <div class="row px-5">
                                <h2 class="text-center mt-2 mb-5" style="color: var(--theme);">Registeration Form</h2>

                            <div>
                                <label for="fName" class="form-label mt-3 fs-5">First Name:</label>
                                <input type="text" class="form-control p-2 mt-2 @error('fName') is-invalid @enderror" id="fName" name="fName" placeholder="Enter your First Name" value="{{old('fName')}}">
                            </div>
                            @error('fName')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="lName" class="form-label mt-4 fs-5">Last Name:</label>
                                <input type="text" class="form-control p-2 mt-2 @error('lName') is-invalid @enderror" id="lName" name="lName" placeholder="Enter your Last Name"  value="{{old('lName')}}">
                            </div>
                            @error('lName')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="email" class="form-label mt-4 fs-5">Email:</label>
                                <input type="email" class="form-control p-2 mt-2 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Username"  value="{{old('email')}}">
                            </div>
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="username" class="form-label mt-4 fs-5">Username:</label>
                                <input type="text" class="form-control p-2 mt-2 @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter Username"  value="{{old('username')}}">
                            </div>
                            @error('username')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="password" class="form-label  fs-5 mt-4">Password:</label>
                                <input type="password" class="form-control p-2 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" value="{{old('password')}}">
                            </div>
                            @error('password')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="role" class="form-label mt-4 fs-5 @error('role') is-invalid @enderror">Role:</label>
                                <select class="form-select" aria-label="Default select example" name="role" value="{{old('role')}}">
                                <option value="student">Student</option>
                                <option value="instructor">Instructor</option>
                                <option value="admin">Admin</option>
                                </select>
                            </div>
                            @error('role')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div>
                                <label for="profile_picture" class="form-label mt-4 fs-5 @error('profile_picture') is-invalid @enderror">Profile Picure:</label>
                                <input type="file" class="form-control p-2 mt-2" id="profile_picture" name="profile_picture">
                            </div>
                            @error('profile_picture')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            <input type="submit" value="Register" class="btn btn-danger rounded my-4 px-3 fs-5 col-12">
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
@endsection
