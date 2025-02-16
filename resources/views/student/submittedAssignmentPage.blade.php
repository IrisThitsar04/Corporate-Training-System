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
        <h1 class="text-center my-4 navFont" style="color: rgb(11, 36, 92)">Submitted Assignments List</h1>
        <div class="container">
        @if ($submissions->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Assignment Name</th>
                        <th>Submitted at</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submissions as $submission)
                        <tr>
                            <td>{{ $submission->title}}</td>
                            <td>{{ $submission->submitted_at }}</td>
                            <td>
                                <a href="{{route('undoTurnInPage', $submission['id'])}}">
                                    <button class="btn btn-danger text-white">Undo Turn In</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No SUbmitted Assignments</p>
        @endif
    </div>
@endsection

