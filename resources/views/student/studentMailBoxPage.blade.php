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
        <h1 class="text-center my-4 navFont" style="color: rgb(11, 36, 92)">Student Mail Box</h1>
        <div class="container">
        <h1 style="color: rgb(11, 36, 92)" class="mt-5 mb-4">Notifications</h1>
        @if ($notifications->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Read at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $notification->data['message'] }}</td>
                            <td>{{ $notification->created_at }}</td>
                            @if ( $notification->read_at !=null)
                                <td>{{ $notification->read_at }}</td>
                            @else
                                <td>Unread</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No notifications</p>
        @endif
    </div>
@endsection

