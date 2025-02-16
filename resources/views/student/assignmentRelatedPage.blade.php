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
    <div class="container-fluid mt-5">
        <div class="row d-flex justify-content-evenly mb-5">
                    <a href="{{route('assignmentPage',Auth::user()->id)}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-8 px-5 d-block align-self-center">
                                <h2 class="mb-4">View Assignments!</h2>
                                <p> View all Upcoming, Past-Due and Completed Assignments</p>
                                <span class="d-flex mt-4">
                                    <h5 class="mt-1">Click Here to View Assignments</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                                </span>
                            </div>
                            <div class="col-4">
                                <img src="{{asset('img/assignment.jpg')}}" style="width: 100%" alt="">
                            </div>
                        </div>
                    </a>
                </div>
               {{-- See Assignments End --}}

               <div class="row d-flex justify-content-evenly mb-5">
                    <a href="{{route('assignmentGradePage')}}" class="card col-11 px-5 py-4 text-decoration-none">
                        <div class="row">
                            <div class="col-8 px-5 d-block align-self-center">
                                <h2 class="mb-4">View Assignments Grade</h2>
                                <p> View Grades of your Submitted Assignments</p>
                                <span class="d-flex mt-4">
                                    <h5 class="mt-1">Click Here to View Assignments Grade</h5>
                                <i class="fa-solid fa-arrow-right mt-2 ms-1 fs-5"></i>
                                </span>
                            </div>
                            <div class="col-4">
                                <img src="{{asset('img/upload_assignment2.avif')}}" style="width: 100%" alt="">
                            </div>
                        </div>
                    </a>
                </div>

        @endsection
