@extends('layouts.studentLayout')

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif


@section('content')
    <div class="container mt-3 text-muted">
        @yield('breadcrumb')
        <div class="row text-center mb-5">
            <div class="row d-flex justify-content-evenly">
                <div class="card h-100 py-3 py-md-0 ms-4">
                    <div class="row">
                        <div class="col-8 d-block align-items-center mt-5 justify-content-center">
                            <h1 class="mb-3 ">@yield('cardtitle')</h1>
                            <p class="mb-4 px-4 px-md-0"> @yield('cardDesc')</p>
                        </div>
                        <div class="col-4">
                            @yield('image')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row mb-1 mt-3">
            <div class="col-12 d-flex justify-content-end" >
                <!-- Sort Course start -->
                <div class="nav-item dropdown">

                                <a class="nav-link dropdown-toggle active homeFont me-2 py-2 fs-6 btn bg-body-secondary px-3 text-secondary" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">
                                <span class="d-none d-sm-inline"><i class="fa-regular fa-calendar-days"></i></span>
                                <span class="d-none d-sm-inline">Sort</span> Course
                                </a>

                  <ul class="dropdown-menu">
                    <li><button type="button" class="dropdown-item my-2">A to Z</button></li>
                    <li><button type="button" class="dropdown-item my-2">Z to A</button></li>
                  </ul>
                </div>
                <!-- Sort Course end -->
            </div>
        </div> --}}
        @yield('courseList')
    </div>
@endsection
