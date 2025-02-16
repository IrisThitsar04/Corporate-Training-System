@extends('layouts.instructorLayout')

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif

@section('content')
<div class="container" id="loginContainer">
        <div class="row mt-5 d-flex justify-content-center mb-5 ">
                    <div class="col-lg-8 col-md-12">
                        {{-- <div class="row">
                            <div class="mb-2">
                                <a href="@yield('back_url')" class="fs-6 text-decoration-none text-muted">
                                    <i class="fa-solid fa-arrow-left mt-1 me-1"></i>
                                    Back
                                </a>
                            </div>
                        </div> --}}
                        @yield('breadcrumb')
                        <div class="row">
                            <div class="card h-100">
                    <div class="d-flex justify-content-center mt-2">
                        @yield('image')
                    </div>
                    <div class="card-body text-muted">
                        <h4 class="card-title text-center mt-3 mb-5">Name: @yield('name')</h4>
                        <p class="card-text"><b>Description : </b> @yield('description')</p>
                        <p class="card-text"><b>Instructor : </b> @yield('instructor_name')</p>
                        <p class="card-text"><b>Start Date : </b> @yield('start_date')</p>
                        <p class="card-text"><b>End Date : </b> @yield('end_date')</p>
                        <p class="card-text mt-3"><b>Duration: </b> @yield('duration')</p>
                    </div>
                    @yield('footer')
                </div>

                        </div>

@endsection
