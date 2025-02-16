@extends('layouts.instructorLayout')

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif

@section('content')
    <div class="row d-flex justify-content-center mb-5">
        <div class="col-8">

            {{-- <div class="row mt-3">
                <div class="" id="breadcrumb">{!! Breadcrumbs::render('instructor.assignment.individual', Auth::user()->id, $course_id, $id) !!}</div>
            </div> --}}

            <h3 class="mt-4 mb-5">Assignment Title: {{$data['title']}}</h3>

            <div class="row mb-5">
                <div class="mb-2">
                    <b>Notes:</b>
                    <p class="mt-3">{{$data['notes']}}</p>
                    <p> <b>Max Score:</b> {{$data['max_score']}}</p>
                    <p> <b>Pass Score:</b> {{$data['pass_score']}}</p>
                </div>
                <div class="my-3">
                    <p> <b>Student Name:</b> {{$data['student_name']}}</p>
                    <p> <b>Submitted File</b> {{$data['submission_file']}}</p>

                    @if(in_array(pathinfo($data['submission_file'], PATHINFO_EXTENSION), ['mp4', 'avi', 'wmv']))
                <video width="100%" height="auto" controls>
                    @if (pathinfo($data['submission_file'], PATHINFO_EXTENSION)=='mp4')
                        <source src="{{asset('storage/'.$data['submission_file'])}}" type="video/mp4">
                    @elseif(pathinfo($data['submission_file'],PATHINFO_EXTENSION)=='avi')
                        <source src="{{asset('storage/'.$data['submission_file'])}}" type="video/x-msvideo">
                    @elseif(pathinfo($data['submission_file'], PATHINFO_EXTENSION)=='wmv')
                        <source src="{{asset('storage/'.$data['submission_file'])}}" type="video/x-ms-wmv">
                    @endif
                    Your Browser Does Not Support the Video Tag
                </video>
            @elseif (in_array(pathinfo($data['submission_file'], PATHINFO_EXTENSION),['txt']))
                <pre>
                    {{file_get_contents(storage_path('app/public/').$data['submission_file'])}}
                </pre>
            @elseif(in_array(pathinfo($data['submission_file'], PATHINFO_EXTENSION),['jpg', 'jpeg', 'png', 'gif']))
                <img src="{{asset('storage/'.$data['submission_file'])}}" alt="" width="80%">

            @elseif(in_array(pathinfo($data['submission_file'],PATHINFO_EXTENSION),['pdf']))
                <span class="mt-3"><a href="{{asset('storage/'.$data['submission_file'])}}">View SUbmitted File </a></span>

            @elseif(in_array(pathinfo($data['submission_file'], PATHINFO_EXTENSION),['doc', 'docx']))
                <span><a href="{{asset('storage/'.$data['lesson_materials'])}}">View SUbmitted File </a></span>
            @else
                <p>The File is not Supported for Direct Display. You can Download the Submitted File  <a href="{{asset('storage/').$data['submission_file']}}">Here</a></p>
            @endif
        </div>
                </div>

            @if (!isset($alreadyGraded) || !$alreadyGraded)
                <form action="{{ route('uploadGrade', ['id' => $data['assignment_id'], 'studentId' => $data['user_id'], 'submission_id'=>$data['id']]) }}" method="post" class="form-control p-3 text-center mt-5" enctype="multipart/form-data">
                @csrf
                    <label for="" class="mb-3 text-muted"><b>Grade this Assignment </b></label>
                    <input type="number" class="form-control" name="marks" id="" placeholder="Enter Grade from 0 to 100">
                    <input type="submit" class="btn btn-danger mt-3" value="Upload Grade">
            </form>
            @else
                <div class="d-flex justify-content-center mt-5">
                    <p class="btn btn-primary text-white">Assignment has already been graded! Please do not Grade Again!</p>
                </div>
            @endif

            </div>
    </div>


@endsection
