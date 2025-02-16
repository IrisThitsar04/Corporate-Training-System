@extends('layouts.instructorLayout')

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif

@section('content')
    <div class="container d-block justify-content-evenly">
        <div class="row mt-4">

                {{-- <div class="row">
                    <div class="" id="breadcrumb">{!! Breadcrumbs::render('instructor.lessons.list', $course_id, $module_id) !!}</div>
                </div> --}}
                    <div class="card h-100 py-1">
                        <div class="row">
                            <div class="col-8 col-md-6 px-5 d-block align-items-center mt-5 justify-content-center offset-md-1">
                                    <h1 class="mb-3 ">Uploaded Lessons</h1>
                                    <p class="mb-4"> View all Uploaded Lessons for this Modules</p>
                                        <a href="{{route('uploadLessonPage',$id)}}" class="btn btn-warning text-white text-center text-decoration-none mb-3"><i class="fa-solid fa-file-arrow-up me-1"></i>Upload Lesson</a>
                                </div>
                                <div class="col-4">
                                <img src="{{ asset('img/create_lesson.avif') }}" style="width:80%; height:100%; object-fit:cover; object-position:left;" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row " id="eventContainer">
                    @foreach ($lessons as $lesson)
                    <div class="col-10 col-md-6 col-lg-4 my-3">
                        <a href="{{route('individualLesson',$lesson['id'])}}" class="text-decoration-none">
                            <div class="card h-100">
                                    <div class="card-body text-center">
                                        <h3 class="card-title mt-3 mb-4 text-muted">{{ $lesson['name'] }}</h3>
                                        <a href="{{route('individualLesson',$lesson['id'])}}" class="card-text text-decoration-none"> Lesson Materials <i class="fa-solid fa-arrow-right mt-1"></i> </a>
                                    </div>
                                    <div class="card-footer justify-content-center">
                                        <div class="row">
                                            <a href="{{ route('editLessonPage', $lesson['id']) }}"
                                            class="col-6 btn text-primary text-decoration-none"><i
                                                class="fa-solid fa-pen-to-square me-1"></i>Edit</a>

                                        <form action="{{ route('delete#lesson', $lesson['id']) }}" method="POST"
                                        id="deleteBtn{{$lesson['id']}}" class="col-6">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn text-danger"
                                                onclick="confirmDelete(event,{{$lesson['id']}})"><i class="fa-solid fa-trash me-1"></i>Delete
                                        </form>
                                        </div>
                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const deleteBtn{{$lesson['id']}} = document.getElementById('deleteBtn{{$lesson['id']}}');
                                                deleteBtn{{$lesson['id']}}.addEventListener('click', function(event) {
                                                    event.preventDefault();

                                                    Swal.fire({
                                                        title: 'Are you sure?',
                                                        text: 'You will not be able to recover this item!',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#d33',
                                                        cancelButtonColor: '#3085d6',
                                                        confirmButtonText: 'Yes, delete it!',
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            deleteBtn{{$lesson['id']}}.submit();
                                                        }
                                                    })
                                                })
                                            })
                                        </script>
                                    </div>
                                </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
