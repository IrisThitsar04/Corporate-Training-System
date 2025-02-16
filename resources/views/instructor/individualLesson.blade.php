@extends('layouts.instructorIndividualLessonLayout')

{{-- @section('backroute',route('uploadedLessonsPage', $lesson['module_id'])) --}}

{{-- @section('breadcrumb')
    <div class="row mt-3">
        <div class="" id="breadcrumb">{!! Breadcrumbs::render('instructor.lesson.individualLesson', $course_id, $module_id) !!}</div>
    </div>
@endsection --}}

@section('backRoute', route('individualLesson', $previousLesson['id']))

@section('nextRoute', route('individualLesson', $nextLesson['id']))

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
        <a href="{{route('uploadedModulesPage', $course_id)}}"
            style="background-color:rgb(211, 189, 67);" class="btn text-white text-center px-4">Next <i
                class="fa-solid fa-arrow-right mt-1 ms-1"></i></a>
    @endif
@endsection
