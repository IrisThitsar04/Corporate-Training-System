@extends('layouts.instructorCourseList')

{{-- @section('breadcrumb')
    <div class="row">
        <div class="mt-3 mb-2" id="breadcrumb">{!! Breadcrumbs::render('admin.chooseCourse') !!}</div>
    </div>
@endsection --}}

@section('cardtitle', 'Choose Assignment First!')

@section('cardDesc', 'Choose Assignment to View View Assginment Grades')

@section('image')
    <img src="{{ asset('img/assignment.jpg') }}" style="width:80%; height:100%; object-fit:cover;" alt="">
@endsection

@section('courseList')
    <div class="row" id="eventContainer">
        @foreach ($assignments as $assignment)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <a href="{{route('assignmentGradeList', $assignment['id'])}}" class="text-decoration-none">
                    <div class="card h-100 text-muted">
                        <h3 class="card-title mt-3 mb-4 text-center fs-lg-3 fs-sm-6 fs-md-5">Assignment :{{ $assignment['title'] }}</h3>
                        <div class="card-body">
                            <p class="card-text mb-2">Due: {{ $assignment['due'] }}</p>
                        <div class="card-text d-flex row mb-2">
                            <div class="col-6">Max Score: {{ $assignment['max_score'] }}</div>
                            <div class="col-6">Pass Score: {{ $assignment['pass_score'] }}</div>
                        </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        {{ $assignments->links() }}
    </div>
@endsection
