<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Styles -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

</head>

<body class="font-sans antialiased p-10">
  
    <div class="">
        <section class="h-100 gradient-form " style="background-color: #eee; min-height:100vh">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-md-6 m-auto">
                                    <div class="card-body p-md-5 mx-md-4">

                                        <div class="text-center">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                                style="width: 185px;" alt="logo">
                                            <h4 class="mt-1 mb-5 pb-1">Wencome to QuinTravel Admin</h4>
                                        </div>

                                        <p>Đăng nhập vô quản trị</p>
                                        <form method="post">
                                            @csrf
                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <label class="form-label fw-bold" for="">Email</label>
                                                <input type="email" value="{{old('email')}}" id="form2Example11" name="email"
                                                    class="form-control" placeholder="Nhập email" />
                                            </div>

                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <label class="form-label fw-bold" for="">Mật khẩu</label>
                                                <input value="{{old('password')}}" type="password" id="" name="password"
                                                    class="form-control" placeholder="Nhập mật khẩu" />
                                            </div>

                                            <div>
                                                @if (session('errorMess'))
                                                    <div class="alert alert-danger">
                                                        {{ session('errorMess') }}
                                                    </div>
                                                @endif


                                            </div>

                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>

                                            </div>



                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
