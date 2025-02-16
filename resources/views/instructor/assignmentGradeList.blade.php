@extends('layouts.instructorLayout')

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
        <h1 class="text-center my-4 navFont" style="color: rgb(11, 36, 92)">Assignment Grade List</h1>
        <div class="container">
        @if ($grades->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Assignment Name</th>
                        <th>Marks</th>
                        <th>Associated Course</th>
                        <th>Uploaded at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td>{{ $grade->id }}</td>
                            <td>{{ $grade->assignment_name}}</td>
                            <td>{{ $grade->marks }}</td>
                            <td>{{ $grade->course_name }}</td>
                            <td>{{ $grade->updated_at }}</td>
                            <td>
                                <a href="{{route('editGrade', $grade->id )}}">
                                    <button class="btn btn-primary">Edit Grade</button>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Students have not yet Submitted any Assignment!</p>
        @endif
    </div>
@endsection

