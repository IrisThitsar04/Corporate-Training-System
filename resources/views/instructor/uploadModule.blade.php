@extends('layouts.instructorForm')

@section('title', 'Module Upload Form')

@section('backRoute', route('uploadedModulesPage', $id))

@section('action', route('upload#module'))

@section('formContent')
    <div>
        <label for="moduleName" class="form-label mt-4 fs-5">Module Name:</label>
        <input type="text" class="form-control p-2 mt-2 @error('moduleName') is-invalid @enderror" id="moduleName"
            name="moduleName" placeholder="Enter Module Name" value="{{ old('moduleName') }}">
    </div>
    @error('moduleName')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="description" class="form-label mt-4 fs-5">Module Description:</label>
        <input type="text" class="form-control p-2 mt-2 @error('description') is-invalid @enderror" id="description"
            name="description" placeholder="Enter Module Name" value="{{ old('description') }}">
    </div>
    @error('description')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="courseName" class="form-label mt-4 fs-5">Associated Course:</label>
        <input type="text" class="form-control p-2 mt-2 @error('courseName') is-invalid @enderror" id="courseName"
            name="courseName" placeholder="Enter Module Name" value="{{ old('courseName') }}">
    </div>
    @error('courseName')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="submit" value="Upload Module" class="btn btn-danger rounded mt-4 mb-4 px-3 fs-5 col-12">
@endsection

@section('image')
    <img class="d-none d-lg-flex mt-0 mt-lg-5" src="{{ asset('img/upload_module2.jpg') }}" style="width: 100%; height:100%; object-fit:contain" alt="">
@endsection
</div>
