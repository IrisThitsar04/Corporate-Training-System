@extends('layouts.instructorLayout')

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-8 offset-2 mb-5">

            @yield('breadcrumb')

            <h1 class="mt-4 mb-3">{{ $lesson['name'] }}</h1>

            @if (in_array(pathinfo($lesson['lesson_materials'], PATHINFO_EXTENSION), ['mp4', 'avi', 'wmv']))
                <video width="100%" height="auto" controls>
                    @if (pathinfo($lesson['lesson_materials'], PATHINFO_EXTENSION) == 'mp4')
                        <source src="{{ asset('storage/' . $lesson['lesson_materials']) }}" type="video/mp4">
                    @elseif(pathinfo($lesson['lesson_materials'], PATHINFO_EXTENSION) == 'avi')
                        <source src="{{ asset('storage/' . $lesson['lesson_materials']) }}" type="video/x-msvideo">
                    @elseif(pathinfo($lesson['lesson_materials'], PATHINFO_EXTENSION) == 'wmv')
                        <source src="{{ asset('storage/' . $lesson['lesson_materials']) }}" type="video/x-ms-wmv">
                    @endif
                    Your Browser Does Not Support the Video Tag
                </video>
            @elseif (in_array(pathinfo($lesson['lesson_materials'], PATHINFO_EXTENSION), ['txt']))
                <pre>
                    {{ file_get_contents(storage_path('app/public/') . $lesson['lesson_materials']) }}
                </pre>
            @elseif(in_array(pathinfo($lesson['lesson_materials'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                <img src="{{ asset('storage/' . $lesson['lesson_materials']) }}" alt="" width="80%">
            @elseif(in_array(pathinfo($lesson['lesson_materials'], PATHINFO_EXTENSION), ['pdf']))
                <span class="mt-3">This is a PDF File. Click <a
                        href="{{ asset('storage/' . $lesson['lesson_materials']) }}">Here </a></span>to View or Download the
                File.
            @elseif(in_array(pathinfo($lesson['lesson_materials'], PATHINFO_EXTENSION), ['doc', 'docx']))
                <span>This is Word document. Click <a href="{{ asset('storage/' . $lesson['lesson_materials']) }}">Here
                    </a></span>to View or Download the File.
            @else
                <p>The File is not Supported for Direct Display. You can Download the File <a
                        href="{{ asset('storage/') . $lesson['lesson_materials'] }}">Here</a></p>
            @endif

            <div class="col-lg-10 col-md-12 my-5">
                <p class="text-muted" style="text-align: justify;">{{ $lesson['notes'] }}</p>
            </div>

            <div class="col-lg-10 col-12 d-flex justify-content-center mt-5">
                @yield('buttons')
            </div>
        </div>
    </div>


@endsection
