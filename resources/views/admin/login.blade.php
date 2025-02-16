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
</head>

<body class="bg-body-tertiary">
    <div class="container d-flex" id="loginContainer">

        <div class="row mt-5 justify-content-center align-content-center mb-5">
            <div class="card col-lg-10 col-md-12">
                <div class="row">
                    <div class="col-lg-5 col-md-4 d-flex align-items-center">
                        <img src="{{ asset('img/login.jpg') }}" style="width: 100%;" alt="">
                    </div>
                    <div class="col-lg-7 col-md-8 col-12">
                        <form class="container-fluid" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-center mt-5">
                                <img src="{{ asset('img/logo1.jpeg') }}" style="width: 12%" alt="">
                            </div>

                            <h4 class="text-center mt-2">Welcome Back! Please Enter your Details!</h4>
                            <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-sm-9 col-md-8 col-lg-12 pt-4 px-5 rounded-3 bg-white">
                                    <div>
                                        <label for="username" class="form-label mt-4 fs-5">Username:</label>
                                        <input type="text"
                                            class="form-control p-2 mt-2 @error('username') is-invalid @enderror"
                                            id="username" name="username" placeholder="Enter Username"
                                            value="{{ old('username') }}">
                                    </div>
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <div>
                                        <label for="email" class="form-label mt-4 fs-5">Email:</label>
                                        <input type="email"
                                            class="form-control p-2 mt-2 @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Enter Username"
                                            value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <div>
                                        <label for="password" class="form-label  fs-5 mt-4">Password:</label>
                                        <input type="password"
                                            class="form-control p-2 @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Enter your password"
                                            value="{{ old('password') }}">
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <input type="submit" value="Login"
                                        class="btn btn-danger rounded mt-4 mb-5 px-3 fs-5 col-12">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

</html>
