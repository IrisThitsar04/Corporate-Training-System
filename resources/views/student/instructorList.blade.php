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
    <div class="container-fluid col-lg-11 col-12  mt-3">
        <div class="row">
            {{-- <div class="my-3" id="breadcrumb">{!! Breadcrumbs::render('admin.studentProgress', $courseId) !!}</div> --}}
        </div>
        <h1 class="text-center my-4 navFont" style="color: rgb(11, 36, 92)">Instructor List</h1>
        <div class="container">
        @if ($instructors->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Instructor Id</th>
                        <th>Course</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($instructors as $instructor)
                        <tr>
                            <td>{{ $instructor->instructor_name }}</td>
                            <td>{{ $instructor->instructor_id}}</td>
                            <td>{{ $instructor->course_name }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>You have not yet Enrolled to any Courses!</p>
        @endif
    </div>
@endsection

