@extends('layouts.studentLayout')

@section('mailbox')
    <li class="nav-item mb-2">
        <a href={{route('studentMailBoxPage')}}
            class="nav-link text-decoration-none ms-3 ms-xl-4 fs-xl-5 fs-6">
            <i class="fa-solid fa-envelope me-2" style="color: rgb(11, 36, 92)"></i>
            <span style="color: rgb(11, 36, 92)">Mail Box</span>
        </a>
    </li>
@endsection

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif


@section('content')
    <div class="container" id="loginContainer">
        <div class="row mt-3 d-flex justify-content-center mb-5">
            {{-- <div class="col-lg-10 col-md-12 mb-2 mt-3">
                <a href="@yield('backRoute')" class="fs-6 text-decoration-none text-muted">
                    <i class="fa-solid fa-arrow-left mt-1 ms-2"></i>
                    Back
                </a>
            </div> --}}
            <div class="col-lg-10 col-md-12 mb-2 mt-3 ">
                @yield('breadcrumb')
            </div>

            <div class="card col-lg-10 col-md-12 text-muted">
                <div class="row">
                    <div class="d-flex justify-content-center mt-5">
                        <img src="{{ asset('img/logo1.jpeg') }}" style="width: 8%" alt="">
                    </div>

                    <h2 class="text-center mt-2">@yield('title')</h2>
                    {{-- <p class="text-center">Fill the Details of the Course Here!</p> --}}
                </div>
                <div class="row">
                    <div class="col-lg-7 col-12">
                        <form class="container-fluid" action="@yield('action')" method="POST" enctype="multipart/form-data"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-sm-9 col-md-8 col-lg-12 pt-4 px-5 rounded-3 bg-white">
                                    @yield('formContent')
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-5">
                        @yield('image')
                    </div>
                </div>
            </div>
        </div>
    @endsection
