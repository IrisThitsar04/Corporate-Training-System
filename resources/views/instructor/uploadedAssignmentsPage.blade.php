@extends('layouts.instructorLayout')

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif

@section('content')
    <div class="container d-block justify-content-evenly">
        <div class="row mt-3 mb-5">
            {{-- <div class="col-12 mb-4">
                <a href="" class="fs-6 text-decoration-none text-muted">
                    <i class="fa-solid fa-arrow-left mt-1"></i>
                    Back
                </a>
            </div> --}}

            {{-- <div class="mt-3" id="breadcrumb">{!! Breadcrumbs::render('instructor.assignments.list', Auth::user()->id, $id) !!}</div> --}}

            <div class="col-12">
                <div class="row mb-4 d-flex justify-content-evenly">
                    <a href="" class="card col-12 text-decoration-none">
                        <div class="row pt-md-3 py-2">
                            <div class="col-8 col-md-6 px-5 d-block align-items-center mt-lg-5 mt-3 justify-content-center offset-md-1">
                                <h1 class="mb-4"> Uploaded Assignments</h1>
                                <p class=""> See all the Uploaded Assignments!</p>
                            </div>
                            <div class="col-4">
                                <img src="{{asset('img/upload_assignment2.jpg')}}" style="width:80%; height:100%; object-fit:cover; object-position:left;" alt="">
                            </div>
                        </div>
                    </a>
                </div>

                <div class="row">
                    @foreach ($assignments as $assignment)
                        <div class="col-12 col-md-6 col-lg-4 my-3">
                            <a href="{{route('individualAssignment', $assignment['id'])}}"
                                class="text-decoration-none text-muted">
                                <div class="card h-100">
                                    <div class="card-body text-muted">
                                        <h3 class="card-title mt-3 mb-4 text-center fs-lg-3 fs-sm-6 fs-md-5">Title: {{ $assignment['title'] }}</h3>
                                        <p class="card-text mb-2">Due: {{ $assignment['due'] }}</p>
                                        <div class="card-text d-flex row mb-2">
                                            <div class="col-6">Max Score: {{ $assignment['max_score'] }}</div>
                                            <div class="col-6">Pass Score: {{ $assignment['pass_score'] }}</div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row d-flex justify-content-center">
                                        <a href="{{ route('editAssignmentPage', $assignment['id']) }}"
                                            class="col-6 btn text-primary text-decoration-none"><i
                                                class="fa-solid fa-pen-to-square me-1"></i>Edit</a>

                                        <form action="{{ route('deleteAssignment', ['id' => $assignment['id'], 'course_id' => $assignment['course_id']]) }}" method="POST"
                                            id="deleteBtn{{ $assignment['id'] }}" class="col-6 ">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn text-danger col-12"
                                                onclick="confirmDelete(event,{{ $assignment['id'] }})"><i
                                                    class="fa-solid fa-trash me-1"></i>Delete
                                        </form>
                                        </div>
                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const deleteBtn{{ $assignment['id'] }} = document.getElementById('deleteBtn{{ $assignment['id'] }}');
                                                deleteBtn{{ $assignment['id'] }}.addEventListener('click', function(event) {
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
                                                            deleteBtn{{ $assignment['id'] }}.submit();
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

        {{ $assignments->links() }}
    </div>
@endsection
