@extends('layouts.instructorForm')

@section('title', 'Assignment Update Form')

{{-- @section('backRoute', route('uploadedAssignmentsPage')) --}}

{{-- @section('breadcrumb')
    <div class="mt-2" id="breadcrumb">{!! Breadcrumbs::render('instructor.assignment.edit', Auth::user()->id, $course_id, $id) !!}</div>
@endsection --}}

@section('action', route('updateAssignment', $id))

@section('formContent')
    <div>
        <label for="assignmentTitle" class="form-label mt-4 fs-5">Assignment Title:</label>
        <input type="text" class="form-control p-2 mt-2 @error('assignmentTitle') is-invalid @enderror" id="assignmentTitle"
            name="assignmentTitle" placeholder="Enter Assignment Title" value="{{ old('assignmentTitle') ?? $assignment['title'] }}">
    </div>
    @error('assignmentTitle')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <label for="notes" class="form-label mt-4 fs-5">Notes:</label>
    <textarea class="form-control p-2 mt-2 @error('notes') is-invalid @enderror" id="notes"
            name="notes" placeholder="Enter Notes" cols="30" rows="10">{{ old('notes') ?? $assignment['notes'] }}</textarea>
    @error('notes')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="courseName" class="form-label mt-4 fs-5">Associated Course:</label>
        <input type="text" class="form-control p-2 mt-2 @error('courseName') is-invalid @enderror" id="courseName"
            name="courseName" placeholder="Enter Associated Course Name" value="{{ old('courseName') ?? $assignment['courseName']}}">
    </div>
    @error('courseName')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="due" class="form-label mt-4 fs-5">Due:</label>
        <input type="datetime-local" class="form-control p-2 mt-2 @error('due') is-invalid @enderror" id="due"
            name="due" placeholder="Enter Due Date and Time" value="{{ old('due') ?? $assignment['due']}}">
    </div>
    @error('due')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="maxScore" class="form-label mt-4 fs-5">Max Score:</label>
        <input type="text" class="form-control p-2 mt-2 @error('maxScore') is-invalid @enderror" id="maxScore"
            name="maxScore" placeholder="Enter Max Score" value="{{ old('maxScore') ?? $assignment['max_score']}}">
    </div>
    @error('maxScore')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="passScore" class="form-label mt-4 fs-5">Pass Score:</label>
        <input type="text" class="form-control p-2 mt-2 @error('passScore') is-invalid @enderror" id="passScore"
            name="passScore" placeholder="Enter Pass Score" value="{{ old('passScore') ?? $assignment['pass_score']}}">
    </div>
    @error('passScore')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="$File" class="form-label mt-4 fs-5">Assignment File:</label>
        <input type="file" class="form-control p-2 mt-2 @error('assignmentFile') is-invalid @enderror"
            id="assignmentFile" name="assignmentFile">
    </div>
    @error('assignmentFile')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="submit" value="Update Assignment" class="btn btn-danger rounded mt-4 mb-4 px-3 fs-5 col-12">
@endsection

@section('image')
    <img class="d-none d-lg-flex mt-0 mt-lg-5" src="{{ asset('img/upload_assignment2.jpg') }}" style="width: 100%; height:57%; object-fit:contain"
        alt="">
@endsection
</div>
