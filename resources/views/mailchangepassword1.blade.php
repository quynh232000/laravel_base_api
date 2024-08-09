<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create Tour</title>




    <style>
        * {
            box-sizing: inherit;
        }

        html,
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body style="height:100vh;
display:flex;flex-direction:column;justify-content:space-between">


    <main style="display: flex;flex-direction:column;padding:10px">
        <div style="display: flex;justify-content: center;">
            <img src="https://quin.mr-quynh.com/assest/images/UNIDI_LOGO-FINAL%202.svg" alt="" width="96">
        </div>
        <style>
            .content {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                flex: 1;
                padding-top: 20px;
                text-align: center

            }
            .btn{
                margin-top: 20px;
                text-decoration: none;
                background-color: blue;
                color: white;
                padding: 10px 30px;
                border-radius: 6px
            }
            #btn-wrapper{
                padding-top: 20px;
            }
        </style>
        <div class="content" style="flex:1;display:flex;justify-content:center;align-items:center">
            <div>
                <h1>Welcome to Quin Travel</h1>
                <p>Xin chào <strong>Mr Quynh</strong> - Vui lòng nhấn đường link dưới đây để xác nhận thay đổi mật khẩu của bạn</p>
            </div>
            <div class="row" id="btn-wrapper">

                <a class="btn" href="">Đổi mật khẩu</a>
            </div>
        </div>
    </main>
    <footer>
        <div style="text-align: center;padding:5px;color: gray; background-color:rgba(22,22,24,.12);padding: 6px;">
            Copyright © 2024 Mr Quynh
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>



</body>

</html>
