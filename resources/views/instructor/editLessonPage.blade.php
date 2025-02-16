@extends('layouts.instructorForm')

@section('title', 'Lesson Update Form')

@section('backRoute', route('uploadedLessonsPage', $id))

@section('action', route('update#lesson',$id))

@section('formContent')
    <div>
        <label for="lessonName" class="form-label mt-4 fs-5">Lesson Name:</label>
        <input type="text" class="form-control p-2 mt-2 @error('lessonName') is-invalid @enderror" id="lessonName"
            name="lessonName" placeholder="Enter Lesson Name" value="{{ old('lessonName') ?? $data['name'] }}">
    </div>
    @error('lessonName')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="moduleName" class="form-label mt-4 fs-5">Associated Module:</label>
        <input type="text" class="form-control p-2 mt-2 @error('moduleName') is-invalid @enderror" id="moduleName"
            name="moduleName" placeholder="Enter Module Name" value="{{ old('moduleName') ?? $data['moduleName']  }}">
    </div>
    @error('moduleName')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <div>
        <label for="lesson_material" class="form-label mt-4 fs-5">Lesson Material:</label>
        <input type="file" class="form-control p-2 mt-2 @error('lesson_material') is-invalid @enderror" id="lesson_material"
            name="lesson_material" placeholder="Enter lesson_material Name">
    </div>
    @error('lesson_material')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="submit" value="Update Lesson" class="btn btn-danger rounded mt-4 mb-4 px-3 fs-5 col-12">
@endsection

@section('image')
    <img class="d-none d-lg-flex mt-0 mt-lg-5" src="{{ asset('img/upload_lesson2.png') }}" style="width: 100%; height:100%; object-fit:contain" alt="">
@endsection
</div>
