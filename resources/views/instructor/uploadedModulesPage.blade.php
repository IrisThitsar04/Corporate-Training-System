@extends('layouts.instructorLayout')

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif

@section('content')
    <div class="container d-block justify-content-evenly">
        <div class="row mt-2 mb-5">

            {{-- <div class="row mt-4 mb-1">
                <div class="col-12" id="breadcrumb">{!! Breadcrumbs::render('instructor.modules.list', $id) !!}</div>
            </div> --}}

            <div class="col-12">
                <div class="row d-flex justify-content-evenly">
                    <div class="card h-100 py-1">
                        <div class="row">
                            <div class="col-8 col-md-6 px-5 d-block align-items-center mt-5 justify-content-center offset-md-1">
                                <h1 class="mb-3 ">Uploaded Modules</h1>
                                <p class="mb-4"> View all Uploaded Modules for this Course</p>
                                <a href="{{ route('uploadModulePage', $id) }}"
                                    class="btn btn-primary text-white text-center text-decoration-none mb-3"><i
                                        class="fa-solid fa-upload me-1"></i>Upload Module</a>
                            </div>
                            <div class="col-4">
                                <img src="{{ asset('img/assignment.jpg') }}" style="width:80%; height:100%; object-fit:cover" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    @foreach ($modules as $module)
                        <div class="col-10 col-md-6 col-lg-4 my-3">
                            <a href="{{ route('uploadedLessonsPage', $module['id']) }}" class="text-decoration-none text-muted">
                                <div class="card h-100">
                                    <div class="card-body text-center text-muted">
                                        <h3 class="card-title mt-3 mb-4">{{ $module['name'] }}</h3>
                                        <p class="card-text mb-4"><b>{{ $module['description'] }}</b> </p>
                                        <a href="{{ route('uploadedLessonsPage', $module['id']) }}" class="card-text text-decoration-none text-muted"> Lessons >>> </a>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <a href="{{ route('editModulePage', $module['id']) }}"
                                            class="col-6 btn text-primary text-decoration-none"><i
                                                class="fa-solid fa-pen-to-square me-1"></i>Edit</a>

                                        <form action="{{ route('delete#module', $module['id']) }}" method="POST"
                                        id="deleteBtn{{$module['id']}}" class="col-6">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn text-danger"
                                                onclick="confirmDelete(event,{{$module['id']}})"><i class="fa-solid fa-trash me-1"></i>Delete
                                        </form>
                                        </div>
                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const deleteBtn{{$module['id']}} = document.getElementById('deleteBtn{{$module['id']}}');
                                                deleteBtn{{$module['id']}}.addEventListener('click', function(event) {
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
                                                            deleteBtn{{$module['id']}}.submit();
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
