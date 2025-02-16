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
    <div class="container-fluid col-lg-11 col-12  mt-3">
        {{-- <div class="row">
            <div class="my-3" id="breadcrumb">{!! Breadcrumbs::render('admin.studentProgress', $courseId) !!}</div>
        </div> --}}
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-muted">Name
                        <span class="fa fa-stack mt-2">
                            <i id="sortUpName" class="fa fa-caret-up" aria-hidden="true"
                                style="position: absolute; top:0;"></i>
                            <i id="sortDownName" class="fa fa-caret-down pb-2" aria-hidden="true"
                                style="position: absolute; bottom:0;"></i>
                        </span>

                    </th>
                    <th class="text-muted">Course
                        <span class="fa fa-stack mt-2">
                            <i class="fa fa-caret-up" id="sortUpCourse" aria-hidden="true"
                                style="position: absolute; top:0;"></i>
                            <i class="fa fa-caret-down pb-2" id="sortDownCourse" aria-hidden="true"
                                style="position: absolute; bottom:0;"></i>
                        </span>
                    </th>
                    <th class="text-muted">Course Status
                        <span class="fa fa-stack mt-2">
                            <i class="fa fa-caret-up" id="sortUpStatus" aria-hidden="true"
                                style="position: absolute; top:0;"></i>
                            <i class="fa fa-caret-down sortDownStatus pb-2" id="sortDownStatus" aria-hidden="true"
                                style="position: absolute; bottom:0;"></i>
                        </span>
                    </th>
                    <th class="text-muted">Completion Percentage
                        <span class="fa fa-stack mt-2">
                            <i class="fa fa-caret-up" id="sortUpPercentage" aria-hidden="true"
                                style="position: absolute; top:0;"></i>
                            <i class="fa fa-caret-down pb-2" id="sortDownPercentage" aria-hidden="true"
                                style="position: absolute; bottom:0;"></i>
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody class="progressTable">
                @foreach ($data as $studentData)
                    <tr>
                        <td class="text-center text-muted">{{ $studentData['studentName'] }}</td>
                        <td class="text-center text-muted">{{ $studentData['courseName'] }}</td>
                        <td class="text-center text-muted">{{ $studentData['course_status'] }}</td>
                        <td class="d-flex justify-content-center pb-3">
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <canvas id="completionChart-{{ $studentData['id'] }}" width="70" height="70"></canvas>
                            <script>
                                var ctx = document.getElementById('completionChart-{{ $studentData['id'] }}').getContext('2d');
                                var completionChart = new Chart(ctx, {
                                    type: 'doughnut',
                                    data: {
                                        // labels: ['Completed', 'Remaining'],
                                        datasets: [{
                                            // labels: ['Completed', 'Remaining'],
                                            data: [{{ $studentData['completion_percentage'] }},
                                                {{ 100 - $studentData['completion_percentage'] }}
                                            ],
                                            borderWidth: 2
                                        }]
                                    },
                                    options: {
                                        responsive: false,
                                        maintainAspectRatio: false,
                                        legend: {
                                            display: false,
                                        },
                                        tooltips: {
                                            callbacks: {
                                                label: function(tooltipItem, data) {
                                                    var dataset = data.datasets[tooltipItem.datasetIndex];
                                                    var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex,
                                                        array) {
                                                        return previousValue + currentValue;
                                                    });
                                                    var currentValue = dataset.data[tooltipItem.index];
                                                    var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                                                    if (tooltipItem.index === 0) {
                                                        return 'Completed: ' + currentValue + '%';
                                                    } else {
                                                        return 'Remaining: ' + currentValue + '%';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>
                            <p class="mt-4 text-muted">
                                {{ $studentData['completion_percentage'] % 1 == 0 ? round($studentData['completion_percentage']) : $studentData['completion_percentage'] }}%
                                {{-- <span class="d-none d-md-inline ms-2">Completed</span> --}}
                            </p>
                        </td>
                    </tr>
                @endforeach
                {{ $data->links() }}
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Define the function to initialize Chart.js
            function initializeChart(id, completion_percentage) {
                var ctx = document.getElementById(id).getContext('2d');
                var completionChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [completion_percentage, 100 - completion_percentage],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: false,
                        maintainAspectRatio: false,
                        legend: {
                            display: false,
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var dataset = data.datasets[tooltipItem.datasetIndex];
                                    var total = dataset.data.reduce(function(previousValue,
                                        currentValue, currentIndex, array) {
                                        return previousValue + currentValue;
                                    });
                                    var currentValue = dataset.data[tooltipItem.index];
                                    var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                                    if (tooltipItem.index === 0) {
                                        return 'Completed: ' + currentValue + '%';
                                    } else {
                                        return 'Remaining: ' + currentValue + '%';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Add event listeners for sorting buttons
            const sortUpName = document.querySelector('#sortUpName');
            const sortDownName = document.querySelector('#sortDownName');
            const sortUpCourse = document.querySelector('#sortUpCourse');
            const sortDownCourse = document.querySelector('#sortDownCourse');
            const sortUpStatus = document.querySelector('#sortUpStatus');
            const sortDownStatus = document.querySelector('#sortDownStatus');
            const sortUpPercentage = document.querySelector('#sortUpPercentage');
            const sortDownPercentage = document.querySelector('#sortDownPercentage');

            sortUpName.addEventListener('click', function() {
                sortData('name', 'asc');
            });

            sortDownName.addEventListener('click', function() {
                sortData('name', 'desc');
            });

            sortUpCourse.addEventListener('click', function() {
                sortData('course', 'asc');
            });

            sortDownCourse.addEventListener('click', function() {
                sortData('course', 'desc');
            });

            sortUpStatus.addEventListener('click', function() {
                sortData('status', 'asc');
            });

            sortDownStatus.addEventListener('click', function() {
                sortData('status', 'desc');
            });

            sortUpPercentage.addEventListener('click', function() {
                sortData('percentage', 'asc');
            });

            sortDownPercentage.addEventListener('click', function() {
                sortData('percentage', 'desc');
            });

            // Function to sort data via AJAX
            function sortData(column, order) {
                $.ajax({
                    url: 'http://127.0.0.1:8000/admin/sortStudentData/' + {{ $courseId }},
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        column: column,
                        order: order
                    },
                    success: function(response) {
                        $list = '';
                        for ($i = 0; $i < response.length; $i++) {
                            $list += `
                            <tr>
                                <td class="text-center text-muted">${response[$i].studentName}</td>
                                <td class="text-center text-muted">${response[$i].courseName}</td>
                                <td class="text-center text-muted">${response[$i].course_status}</td>
                                <td class="d-flex justify-content-center pb-3">
                                    <canvas id="completionChart-${response[$i].id}" width="70" height="70"></canvas>
                                    <p class="mt-4 text-muted">${Math.round(response[$i].completion_percentage)}%</p>
                                </td>
                            </tr>
                        `;
                        }

                        $('.progressTable').html($list);

                        // After updating the table content, call the initializeChart function for each chart
                        for (let j = 0; j < response.length; j++) {
                            initializeChart(`completionChart-${response[j].id}`, response[j]
                                .completion_percentage);
                        }
                    }
                });
            }
        });
    </script>
@endsection
