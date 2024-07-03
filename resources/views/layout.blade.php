<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create Tour</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Styles -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
@stack('css')
@stack('js1')
</head>

<body class="font-sans antialiased p-10">
    <div class="bg-primary">
        <nav class="navbar navbar-expand-lg  container">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="/">Quin Travel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="/api/documentation">API</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="/create">Tạo tour</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="/news">Tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="/create_news">Tạo tin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="/user">Users</a>
                        </li>


                    </ul>

                    <div>
                        <div class="nav-item dropdown text-white">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Hi, {{ auth('web')->user()->full_name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Hồ sơ</a></li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ url('/logout') }}">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    @yield('main')
   <footer class="position-fixed bottom-0 start-0 end-0">
    <div class="border-top py-2 text-center text-[12px]" style="color: gray; background-color:rgba(22,22,24,.12)">
        Copyright © 2024 Mr Quynh
    </div>
   </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    @stack('js')
    <script></script>
    <script>
        let quillIndex = 0;
        $("#btn-add").click(function() {

            $("#process_detail").append(`
                 <div class="border p-2 border-primary mb-2">
                     <input type="text" name="content[]" class="d-none" id="content${quillIndex}">
                    <div class="mb-2">
                        <label class="fw-bold" for="">Ngày <span>${+quillIndex+1}</span></label>
                        <input type="date" name="date[]" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="fw-bold" for="">Tiêu đề <span></span></label>
                        <input type="text" name="title_process[]" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="fw-bold" for="">Content <span></span></label>
                        <div id="editor${quillIndex}"  style="min-height: 60px">
                        
                        </div>
                    </div>
                </div>

            `)
            new Quill('#editor' + quillIndex, {
                theme: 'snow'
            });
            quillIndex++;
        })
        // submit form 
        $("#form-create").on('submit', function(e) {
            // e.preventDefault();
            // submit data to server
            for (let index = 0; index < quillIndex; index++) {
                $("#content" + index).val($('#editor' + index).html());
            }
        })
    </script>

</body>

</html>
