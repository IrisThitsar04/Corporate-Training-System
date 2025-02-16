@extends('layouts.layout')

@section('navCoursesRoute', route('courseRelatedPage'))
@section('navInstructorsRoute', route('instructorsRelatedPage'))
@section('navStudentsRoute', route('studentsRelatedPage'))
@section('navAdminRoute', route('adminRelatedPage'))
@section('navHomeRoute', route('user#dashboard'))
@section('navProfileRoute', route('manageProfilePage'))
@section('navEditProfileRoute', route('adminEditProfilePage'))

@if($navProfile!=null)
    @section('navProfile',asset('storage/'.$navProfile))
@else
    @section('navProfile',asset('img/profile_not_found.webp'))
@endif


@section('content')
    <div class="container-fluid col-lg-11 col-12  mt-3">
        <div class="row">
            {{-- <div class="my-3" id="breadcrumb">{!! Breadcrumbs::render('admin.studentProgress', $courseId) !!}</div> --}}
        </div>
        <h1 class="text-center my-4 navFont" style="color: rgb(11, 36, 92)">Enrolled Instructor List</h1>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-muted">Instructor Name
                        <span class="fa fa-stack mt-2">
                            <i id="sortUpName" class="fa fa-caret-up" aria-hidden="true"
                                style="position: absolute; top:0;"></i>
                            <i id="sortDownName" class="fa fa-caret-down pb-2" aria-hidden="true"
                                style="position: absolute; bottom:0;"></i>
                        </span>
                    </th>

                    <th class="text-muted">Email
                        <span class="fa fa-stack mt-2">
                            <i id="sortUpEmail" class="fa fa-caret-up" aria-hidden="true"
                                style="position: absolute; top:0;"></i>
                            <i id="sortDownEmail" class="fa fa-caret-down pb-2" aria-hidden="true"
                                style="position: absolute; bottom:0;"></i>
                        </span>
                    </th>

                    <th class="text-muted">Assigned Courses
                        <span class="fa fa-stack mt-2">
                            <i class="fa fa-caret-up" id="sortUpCourse" aria-hidden="true"
                                style="position: absolute; top:0;"></i>
                            <i class="fa fa-caret-down pb-2" id="sortDownCourse" aria-hidden="true"
                                style="position: absolute; bottom:0;"></i>
                        </span>
                    </th>

                    <th>Registered at
                        <span class="fa fa-stack mt-2">
                            <i class="fa fa-caret-up" id="sortUpRegistration" aria-hidden="true"
                                style="position: absolute; top:0;"></i>
                            <i class="fa fa-caret-down sortDownRegistration pb-2" id="sortDownRegistration" aria-hidden="true"
                                style="position: absolute; bottom:0;"></i>
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody class="listTable">
                @php
                $userCourses = [];

                // Group courses by user
                foreach ($listData as $courseEnrollment) {
                    if (!isset($userCourses[$courseEnrollment->username])) {
                        $userCourses[$courseEnrollment->username] = [
                            'email' => $courseEnrollment->email,
                            'courses' => [],
                            'created_at' => $courseEnrollment->created_at,
                        ];
                    }
                    $userCourses[$courseEnrollment->username]['courses'][] = $courseEnrollment->course_name;
                }
            @endphp
                @foreach ($userCourses as $username => $userData)
                    <tr>
                        <td class="text-center text-muted">{{ $username }}</td>
                        <td class="text-center text-muted">{{ $userData['email'] }}</td>
                        <td class="text-center text-muted">{{ implode(', ', $userData['courses']) }}</td>
                        <td class="text-center text-muted">{{ $userData['created_at'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $listData->links() }}
    </div>
    <script>
                const sortUpName = document.querySelector('#sortUpName');
                const sortDownName = document.querySelector('#sortDownName');
                const sortUpEmail = document.querySelector('#sortUpEmail');
                const sortDownEmail = document.querySelector('#sortDownEmail');
                const sortUpCourse = document.querySelector('#sortUpCourse');
                const sortDownCourse = document.querySelector('#sortDownCourse');
                const sortUpRegistration = document.querySelector('#sortUpRegistration');
                const sortDownRegistration = document.querySelector('#sortDownRegistration');

                sortUpName.addEventListener('click', function() {
                    sortData('name', 'asc');
                });

                sortDownName.addEventListener('click', function() {
                    sortData('name', 'desc');
                });

                sortUpEmail.addEventListener('click', function() {
                    sortData('email', 'asc');
                });

                sortDownEmail.addEventListener('click', function() {
                    sortData('email', 'desc');
                });

                sortUpCourse.addEventListener('click', function() {
                    sortData('course', 'asc');
                });

                sortDownCourse.addEventListener('click', function() {
                    sortData('course', 'desc');
                });

                sortUpRegistration.addEventListener('click', function() {
                    sortData('registration', 'asc');
                });

                sortDownRegistration.addEventListener('click', function() {
                    sortData('registration', 'desc');
                });

                function sortData(column, order) {
                $.ajax({
                    url: '{{ route("sortInstructorList") }}',

                    method: 'GET',
                    dataType: 'json',
                    data: {
                        column: column,
                        order: order
                    },
                    success: function (response) {
                                appendSortedData(response); // Append sorted data to the table
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX request failed:", status, error);
                            }
                        });
                    }

                    function appendSortedData(response) {
                        let tableBody = $('.listTable');
                        tableBody.empty(); // Clear existing table data
                        let userData = {};
                        if (response && Array.isArray(response.data)) {
                            response.data.forEach(item => {
                                if (!userData[item.username]) {
                                    userData[item.username] = {
                                        username: item.username,
                                        email: item.email,
                                        courses: [],
                                        created_at: item.created_at
                                    };
                                }
                                userData[item.username].courses.push(item.course_name);
                            });

                            Object.values(userData).forEach(user => {
                                let row = `
                                    <tr>
                                        <td class="text-center text-muted">${user.username}</td>
                                        <td class="text-center text-muted">${user.email}</td>
                                        <td class="text-center text-muted">${user.courses.join(', ')}</td>
                                        <td class="text-center text-muted">${user.created_at}</td>
                                    </tr>`;
                                tableBody.append(row);
                            });
                        } else {
                            console.error('Unexpected data format:', response);
                        }
                    }
                </script>
@endsection
