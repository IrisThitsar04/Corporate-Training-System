<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Jquery link -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstap JS link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <style>
        #breadcrumb {
            text-decoration: none;
            color: #467dae;
            font-size: 13px;
        }

        #breadcrumb a {
            text-decoration: none !important;
            color: #467dae;
        }

        .navFont {
            font-family: "Raleway", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }
    </style>

</head>

<body class="bg-light">
    <div class="container-fluid">
        {{-- Nav Bar Start --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-white position-sticky top-0 z-1 shadow-sm">
            <div class="container-fluid">
                <div class="navbar-brand d-flex align-items-center col-3">
                    <img src="{{ asset('img/logo1.jpeg') }}" style="width: 13%" alt="">
                    <h3 class="mt-1" style="color: rgb(11, 36, 92)">Aspire</h3>
                </div>
                <button class="navbar-toggler text-end" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars p-1"></i>
                </button>
                <div class="collapse navbar-collapse d-flex justify-content-center" id=navbarNav>
                    <div class="col-5">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item me-4">
                                <a href="@yield('navHomeRoute')" class="nav-link navFont"
                                    style="color: rgb(11, 36, 92)"><b>Home</b></a>
                            </li>
                            <li class="nav-item me-4">
                                <a href="@yield('navCoursesRoute')" class="nav-link navFont"
                                    style="color: rgb(11, 36, 92)"><b>Courses</b></a>
                            </li>
                            <li class="nav-item me-4">
                                <a href="@yield('navInstructorsRoute')" class="nav-link navFont"
                                    style="color: rgb(11, 36, 92)"><b>Instructors</b></a>
                            </li>
                            <li class="nav-item me-4">
                                <a href="@yield('navStudentsRoute')" class="nav-link navFont"
                                    style="color: rgb(11, 36, 92)"><b>Students</b></a>
                            </li>
                            <li class="nav-item me-4">
                                <a href="@yield('navAdminRoute')" class="nav-link navFont"
                                    style="color: rgb(11, 36, 92)"><b>Admins</b></a>
                            </li>
                    </div>


                    <ul class="navbar-nav col-3 offset-1 d-flex justify-content-end">
                        <img src="@yield('navProfile')" width="15%" height="15%" alt="" class="rounded">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle navFont" data-bs-toggle="dropdown" href="#"
                                role="button" aria-expanded="false" style="color: rgb(11, 36, 92)"><b>My
                                    Profile</b></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item mb-2 text-muted" href="@yield('navProfileRoute')"><i
                                            class="fa-solid fa-user me-2" style="color: rgb(11, 36, 92)"></i><span
                                            style="color: rgb(11, 36, 92)">View Profile</span></a></li>
                                <li><a class="dropdown-item text-muted" href="@yield('navEditProfileRoute')"><i
                                            class="fa-solid fa-user-pen me-2" style="color: rgb(11, 36, 92)"></i><span
                                            style="color: rgb(11, 36, 92)">Edit Profile</span></a></li>
                                <li>
                                    <form class="dropdown-item text-danger" action="{{ route('logout') }}"
                                        method="POST">
                                        @csrf
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        <button type="submit"
                                            class="bg-white btn text-danger"><span>Logout</span></button>
                                    </form>
                                </li>

                            </ul>
                        </li>
                    </ul>

                    </ul>
                </div>
            </div>
        </nav>
        {{-- Nav Bar End --}}

        <div class="row">
            {{-- Side Bar Start --}}
            <div class="col-2 bg-white d-none d-lg-block">
                <nav class="navbar position-fixed">
                    <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                        <li class="nav-item mb-2"><a href=@yield('navHomeRoute')
                                class="nav-link text-decoration-none ms-3 ms-xl-4 fs-xl-5 fs-6 mt-3">
                                <i class="fa-solid fa-house me-2" style="color: rgb(11, 36, 92)"></i>
                                <span style="color: rgb(11, 36, 92)">Home</span></a></li>
                        <li class="nav-item mb-2"><a href=@yield('navCoursesRoute')
                                class="nav-link text-decoration-none ms-3 ms-xl-4 fs-xl-5 fs-6">
                                <i class="fa-solid fa-book-open-reader me-2" style="color: rgb(11, 36, 92)"></i>
                                <span style="color: rgb(11, 36, 92)">Courses</span></a></li>

                        <li class="nav-item mb-2"><a href=@yield('navInstructorsRoute')
                                class="nav-link text-decoration-none ms-3 ms-xl-4 fs-xl-5 fs-6">
                                <i class="fa-solid fa-chalkboard-user me-2" style="color: rgb(11, 36, 92)"></i>
                                <span style="color: rgb(11, 36, 92)">Instructors</span></a></li>
                        <li class="nav-item mb-2"><a href=@yield('navStudentsRoute')
                                class="nav-link text-decoration-none ms-3 ms-xl-4 fs-xl-5 fs-6">
                                <i class="fa-solid fa-user-graduate me-2" style="color: rgb(11, 36, 92)"></i>
                                <span style="color: rgb(11, 36, 92)">Students</span></a></li>
                        <li class="nav-item mb-2"><a href=@yield('navAdminRoute')
                                class="nav-link text-decoration-none ms-3 ms-xl-4 fs-xl-5 fs-6">
                                <i class="fa-solid fa-user-gear me-2" style="color: rgb(11, 36, 92)"></i>
                                <span style="color: rgb(11, 36, 92)">Admins</span></a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-decoration-none ms-3 ms-xl-4 fs-xl-5 fs-6"
                                data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i
                                    class="fa-solid fa-user me-3" style="color: rgb(11, 36, 92)"></i><span
                                    style="color: rgb(11, 36, 92)">My Profile</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item mb-2 text-muted" href="@yield('navProfileRoute')"><i
                                            class="fa-solid fa-user me-2" style="color: rgb(11, 36, 92)"></i>View
                                        Profile</a></li>
                                <li><a class="dropdown-item text-muted" href="@yield('navEditProfileRoute')"><i
                                            class="fa-solid fa-user-pen me-2" style="color: rgb(11, 36, 92)"></i>Edit
                                        Profile</a></li>
                                <li>
                                    <form class="dropdown-item text-danger" action="{{ route('logout') }}"
                                        method="POST">
                                        @csrf
                                        <i class="fa-solid fa-right-from-bracket" style="color: rgb(11, 36, 92)"></i>
                                        <input type="submit" class="bg-white btn text-danger" value="Logout">
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            {{-- Side Bar End --}}

            <div class="col-lg-10" style="background-color:rgb(245, 249, 249)">
                @yield('content')
            </div>
        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

</html>
