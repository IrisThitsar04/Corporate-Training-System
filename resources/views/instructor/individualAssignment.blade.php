@extends('layouts.instructorLayout')

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif

@section('content')
    <div class="row d-flex justify-content-center mb-5">
        {{-- <div class="col-11 my-3">
                <a href="@yield('backroute')" class="fs-6 text-decoration-none text-muted">
                    <i class="fa-solid fa-arrow-left mt-1 ms-2"></i>
                    Back
                </a>
            </div> --}}
        <div class="col-8">

            {{-- <div class="row mt-3">
                <div class="" id="breadcrumb">{!! Breadcrumbs::render('instructor.assignment.individual', Auth::user()->id, $course_id, $id) !!}</div>
            </div> --}}

            <h3 class="mt-4 mb-5">Assignment Title: {{$data['title']}}</h3>

            <div class="row mb-5">
                <div class="col-8">
                    <b>Notes:</b>
                    <p class="mt-3">{{$data['notes']}}</p>
                </div>
                <div class="col-4">
                    <p> <b>Due:</b> {{$data['due']}}</p>
                    <p> <b>Max Score:</b> {{$data['max_score']}}</p>
                    <p> <b>Pass Score:</b> {{$data['pass_score']}}</p>
                </div>
            </div>

            @if(in_array(pathinfo($data['assignment_file'], PATHINFO_EXTENSION), ['mp4', 'avi', 'wmv']))
                <video width="100%" height="auto" controls>
                    @if (pathinfo($data['assignment_file'], PATHINFO_EXTENSION)=='mp4')
                        <source src="{{asset('storage/'.$data['assignment_file'])}}" type="video/mp4">
                    @elseif(pathinfo($data['assignment_file'],PATHINFO_EXTENSION)=='avi')
                        <source src="{{asset('storage/'.$data['assignment_file'])}}" type="video/x-msvideo">
                    @elseif(pathinfo($data['assignment_file'], PATHINFO_EXTENSION)=='wmv')
                        <source src="{{asset('storage/'.$data['assignment_file'])}}" type="video/x-ms-wmv">
                    @endif
                    Your Browser Does Not Support the Video Tag
                </video>
            @elseif (in_array(pathinfo($data['assignment_file'], PATHINFO_EXTENSION),['txt']))
                <pre>
                    {{file_get_contents(storage_path('app/public/').$data['assignment_file'])}}
                </pre>
            @elseif(in_array(pathinfo($data['assignment_file'], PATHINFO_EXTENSION),['jpg', 'jpeg', 'png', 'gif']))
                <img src="{{asset('storage/'.$data['assignment_file'])}}" alt="" width="80%">

            @elseif(in_array(pathinfo($data['assignment_file'],PATHINFO_EXTENSION),['pdf']))
                <span class="mt-3">This is a PDF File. Click <a href="{{asset('storage/'.$data['assignment_file'])}}">Here </a></span>to View or Download the File.

            @elseif(in_array(pathinfo($data['assignment_file'], PATHINFO_EXTENSION),['doc', 'docx']))
                <span>This is Word document. Click <a href="{{asset('storage/'.$data['lesson_materials'])}}">Here </a></span>to View or Download the File.
            @else
                <p>The File is not Supported for Direct Display. You can Download the File  <a href="{{asset('storage/').$data['lesson_materials']}}">Here</a></p>
            @endif
        </div>
    </div>


@endsection
