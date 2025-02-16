@extends('layouts.form')

@section('title', 'Student Enrollment Form')

@section('backRoute', route('adminDashboard'))

@section('action', route('enroll#student'))

@section('formContent')
    <div class="">
        <label for="studentName" class="form-label mt-5 fs-5">Student Name:</label>
        <input type="text" class="form-control p-2 mt-2 @error('studentName') is-invalid @enderror" id="studentName"
            name="studentName" placeholder="Enter Student Name" value="{{ old('studentName') }}">
    </div>
    @error('studentName')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="courseName" class="form-label mt-4 fs-5">Course Name:</label>
        <input type="text" class="form-control p-2 mt-2 mb-3 @error('courseName') is-invalid @enderror" id="courseName"
            name="courseName" placeholder="Enter Course Name" value="{{ old('courseName') }}">
    </div>
    @error('courseName')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="submit" value="Enroll Student" class="btn btn-danger rounded mt-4 mb-4 px-3 fs-5 col-12">
@endsection

@section('image')
    <img src="{{ asset('img/upload_lesson2.png') }}" style="width: 100%; height:100%; object-fit:contain" alt="">
@endsection
</div>
