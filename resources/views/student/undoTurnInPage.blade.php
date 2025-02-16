@extends('layouts.studentForm')

@section('title', 'Undo Turn In Form')

@section('action', route('assignmentTurnInAgain', $data['id']))

@section('formContent')
    <div>
        <label for="" class="form-label mt-4 fs-5">Assignment Name:</label>
        <input type="text" class="form-control p-2 mt-2" id="assignmentName"
            name="assignmentName" placeholder="Enter Assignment Name" value="{{$data['title'] }}">
    </div>

    <div>
        <label for="" class="form-label mt-4 fs-5">File:</label>
            <input type="file" class="form-control" name="submission" id="">
    </div>

    <input type="submit" value="Turn In Again" class="btn btn-danger rounded mt-4 mb-4 px-3 fs-5 col-12">
@endsection

@section('image')
    <img class="d-none d-lg-flex mt-0 mt-lg-5" src="{{ asset('img/upload_lesson2.png') }}" style="width: 100%; height:100%; object-fit:contain" alt="">
@endsection
</div>

