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
                <div class="">
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
                <p class=" mb-1">Click the Button Below to View the Attached Image</p>
                <img src="{{asset('storage/'.$data['assignment_file'])}}" alt="" width="80%">
                <a href="{{asset('storage/'.$data['assignment_file'])}}"><button type="button" class="btn mt-3" style="background-color: rgb(214, 216, 216)">{{$data['assignment_file']}}</button></a>
            @elseif(in_array(pathinfo($data['assignment_file'],PATHINFO_EXTENSION),['pdf']))
                <p class=" mb-1">Click the Button Below to View the Attached File</p>
                <a href="{{asset('storage/'.$data['assignment_file'])}}"><button type="button" class="btn" style="background-color: rgb(214, 216, 216)">{{$data['assignment_file']}}</button></a>

            @elseif(in_array(pathinfo($data['assignment_file'], PATHINFO_EXTENSION),['doc', 'docx']))
                <p class=" mb-1">Click the Button Below to View the Attached File</p>
                <a href="{{asset('storage/'.$data['assignment_file'])}}"><button type="button" class="btn" style="background-color: rgb(214, 216, 216)">{{$data['assignment_file']}}</button></a>
            @else
                <p>The File is not Supported for Direct Display. You can Download the File  <a href="{{asset('storage/').$data['lesson_materials']}}">Here</a></p>
            @endif

                    <div class="mt-5"><b>Notes:</b></div>
                    <p class="mt-3">{{$data['notes']}}</p>
                </div>
                <div class="mt-3">
                    <p> <b>Due:</b> {{$data['due']}}</p>
                    <p> <b>Max Score:</b> {{$data['max_score']}}</p>
                    <p> <b>Pass Score:</b> {{$data['pass_score']}}</p>
                </div>
            </div>

              @if (isset($alreadySubmitted) && $alreadySubmitted)
                <form action="" class="form-control p-3 text-center mt-4">
                        <label for="" class="mb-3 text-danger"><b>Assignment has been Submitted!</b></label>
                        <div class="d-flex justify-content-center mt-3">
                        <p class="btn btn-warning text-white">Undo Turn In</p>
                    </div>
                </form>
            @endif

            <form action="{{route('submitAssignment',$data['id'] )}}" method="post" class="form-control p-3 text-center mt-5" enctype="multipart/form-data">
                @csrf
                    <label for="" class="mb-3 text-muted"><b>Attach your Work Here</b></label>
                    <input type="file" class="form-control" name="submission" id="">
                    <div>
                        @error('submission')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>

                    <input type="submit" class="btn btn-danger mt-3" value="Submit Assignment">
            </form>

        </div>
    </div>


@endsection
