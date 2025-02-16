@extends('layouts.instructorLayout')

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
        
        @yield('courseList')
    </div>
@endsection
