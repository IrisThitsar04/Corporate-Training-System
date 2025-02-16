@extends('layouts.studentIndividualLayout')
{{-- 
@section('breadcrumb')
    <div class="row mt-3">
        <div class="" id="breadcrumb">{!! Breadcrumbs::render('student.individualLesson', $course_id, Auth::user()->id, $lesson['module_id'], $lesson['id']) !!}</div>
    </div>
@endsection --}}

@section('mailbox')
    <li class="nav-item mb-2">
        <a href={{route('studentMailBoxPage')}}
            class="nav-link text-decoration-none ms-3 ms-xl-4 fs-xl-5 fs-6">
            <i class="fa-solid fa-envelope me-2" style="color: rgb(11, 36, 92)"></i>
            <span style="color: rgb(11, 36, 92)">Mail Box</span>
        </a>
    </li>
@endsection

@section('buttons')
    @if (!is_null($previousLesson))
        <a href="{{route('individualLessonPage', $previousLesson['id'])}}"
            style="background-color: rgb(125, 172, 194);" class="btn text-white me-3 text-center px-3"> <i
                class="fa-solid fa-arrow-left me-1"></i> Previous</a>
    @endif

    @if (!is_null($nextLesson))
        <a href="{{route('individualLessonPage', $nextLesson['id'])}}"
            style="background-color:rgb(67, 123, 149);" class="btn text-white text-center px-4">Next <i
                class="fa-solid fa-arrow-right mt-1 ms-1"></i></a>
    @else
        <form action="{{route('moduleDone', ['id'=>$lesson['id'], 'moduleId'=>$lesson['module_id']])}}" method="POST">
            @csrf
            <input type="submit" value="Done"
                            class="btn btn-warning text-white text-center px-4">
        </form>
    @endif
@endsection
