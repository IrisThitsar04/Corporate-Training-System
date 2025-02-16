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
        <h1 class="text-center my-4 navFont" style="color: rgb(11, 36, 92)">Registered Admin List</h1>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-muted">Admin Full Name
                        <span class="fa fa-stack mt-2">
                            <i id="sortUpName" class="fa fa-caret-up" aria-hidden="true"
                                style="position: absolute; top:0;"></i>
                            <i id="sortDownName" class="fa fa-caret-down pb-2" aria-hidden="true"
                                style="position: absolute; bottom:0;"></i>
                        </span>
                    </th>

                    <th class="text-muted">First Name
                        <span class="fa fa-stack mt-2">
                            <i id="sortUpFirstName" class="fa fa-caret-up" aria-hidden="true"
                                style="position: absolute; top:0;"></i>
                            <i id="sortDownFirstName" class="fa fa-caret-down pb-2" aria-hidden="true"
                                style="position: absolute; bottom:0;"></i>
                        </span>
                    </th>

                    <th class="text-muted">Last Name
                        <span class="fa fa-stack mt-2">
                            <i id="sortUpLastName" class="fa fa-caret-up" aria-hidden="true"
                                style="position: absolute; top:0;"></i>
                            <i id="sortDownLastName" class="fa fa-caret-down pb-2" aria-hidden="true"
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

                    <th class="text-muted">Registered at
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
                @foreach ($listData as $adminData)
                    <tr>
                        <td class="text-center text-muted">{{ $adminData['username'] }}</td>
                        <td class="text-center text-muted">{{ $adminData['first_name'] }}</td>
                        <td class="text-center text-muted">{{ $adminData['last_name'] }}</td>
                        <td class="text-center text-muted">{{ $adminData['email'] }}</td>
                        <td class="text-center text-muted">{{ $adminData['created_at'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $listData->links() }}
    </div>
    <script>
                const sortUpName = document.querySelector('#sortUpName');
                const sortDownName = document.querySelector('#sortDownName');
                const sortUpFirstName = document.querySelector('#sortUpFirstName');
                const sortDownFirstName = document.querySelector('#sortDownFirstName');
                const sortUpLastName = document.querySelector('#sortUpLastName');
                const sortDownLastName = document.querySelector('#sortDownLastName');
                const sortUpEmail = document.querySelector('#sortUpEmail');
                const sortDownEmail = document.querySelector('#sortDownEmail');
                const sortUpRegistration = document.querySelector('#sortUpRegistration');
                const sortDownRegistration = document.querySelector('#sortDownRegistration');

                sortUpName.addEventListener('click', function() {
                    sortData('name', 'asc');
                });

                sortDownName.addEventListener('click', function() {
                    sortData('name', 'desc');
                });

                sortUpFirstName.addEventListener('click', function() {
                    sortData('firstname', 'asc');
                });

                sortDownFirstName.addEventListener('click', function() {
                    sortData('firstname', 'desc');
                });

                sortUpLastName.addEventListener('click', function() {
                    sortData('lastname', 'asc');
                });

                sortDownLastName.addEventListener('click', function() {
                    sortData('lastname', 'desc');
                });

                sortUpEmail.addEventListener('click', function() {
                    sortData('email', 'asc');
                });

                sortDownEmail.addEventListener('click', function() {
                    sortData('email', 'desc');
                });

                sortUpRegistration.addEventListener('click', function() {
                    sortData('registration', 'asc');
                });

                sortDownRegistration.addEventListener('click', function() {
                    sortData('registration', 'desc');
                });

          function sortData(column, order) {
    $.ajax({
        url: '{{ route("sortAdminList") }}',
        method: 'GET',
        dataType: 'json',
        data: {
            column: column,
            order: order
        },
        success: function(response) {
            console.log('Sorted Data:', response); // Log sorted data
            updateTable(response.data); // Update table with sorted data
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error); // Log AJAX error
        }
    });
}


function updateTable(data) {
    let tableBody = $('.listTable');
    tableBody.empty(); // Clear existing table data
    if (Array.isArray(data) && data.length > 0) {
        data.forEach(item => {
            // Build HTML for each row
            let row = `
                <tr>
                    <td class="text-center text-muted">${item.username}</td>
                    <td class="text-center text-muted">${item.first_name}</td>
                    <td class="text-center text-muted">${item.last_name}</td>
                    <td class="text-center text-muted">${item.email}</td>
                    <td class="text-center text-muted">${item.created_at}</td>
                </tr>`;
            tableBody.append(row); // Append row to table body
        });
    } else {
        console.error('No data received or unexpected data format:', data); // Log unexpected data format
    }
}


                </script>
@endsection

