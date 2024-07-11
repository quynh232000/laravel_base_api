<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create Tour</title>





</head>

<body class="font-sans antialiased p-10">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <header>
        <div class="container py-2 d-flex justify-content-center gap-3 align-items-center">
            <img src="{{ asset('/images/logo.png') }}" alt="" width="96">
        </div>
    </header>
    <main>
        <div class="container pb-5 mb-5">
            <div class="row">
                <div class="col-mg-6 m-auto">
                    <h5 class="py-2">Cảm ơn quý khách đã tin tưởng đặt Tour bên QuinTravel!</h5>
                    <div class="">
                        <div class="fw-bold text-success">Thông tin khách hàng</div>
                        <div class="border-top border-warning p-2 rounded-3">
                            <div class="d-flex gap-2 mb-2">
                                <label for="" class="fw-bold text-secondary">Họ tên: </label>
                                <i class="fs-6 text-danger">{{ $data['order']['full_name'] }}</i>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <label for="" class="fw-bold text-secondary">Email: </label>
                                <i class="fs-6 text-danger">{{ $data['order']['email'] }}</i>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <label for="" class="fw-bold text-secondary">Số điện thoại: </label>
                                <i class="fs-6 text-danger">{{ $data['order']['phone_number'] }}</i>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <label for="" class="fw-bold text-secondary">Địa chỉ: </label>
                                <i class="fs-6 text-danger">{{ $data['order']['address'] }}</i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="fw-bold text-success mt-3">Trạng thái thanh toán</div>
                        <div class="mt-2 alert alert-warning text-center fw-bold text-primary">
                            {{ $data['order']['status'] == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</div>
                    </div>
                    <div class="">
                        <div class="fw-bold text-success">Chi tiết đơn hàng đơn hàng</div>
                        <div class=" border-2 border-warning p-4 rounded-3"
                            style="background-color: rgba(193, 193, 235, 0.12)">
                            <div class="d-flex gap-2 mb-2">
                                <label for="" class="fw-bold text-secondary">Địa điểm: </label>
                                <i class="fs-6 text-primary fw-bold">{{ $data['tour']['title'] }}</i>
                            </div>

                            <div class="d-flex gap-2 mb-2 justify-content-center">
                                <img style="" class="img-fluid rounded-4"
                                    src="{{ asset('/storage/') . $data['tour']['thumnail'] }}" alt="">
                            </div>

                            <div class="d-flex gap-2 mb-2">
                                <label for="" class="fw-bold text-secondary">Ngày đặt: </label>
                                <i class="fs-6 text-danger">{{ $data['order']['created_at'] }}</i>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <label for="" class="fw-bold text-secondary">Ngày khởi hành: </label>
                                <i class="fs-6 text-danger">{{ $data['tour']['date_start'] }}</i>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <label for="" class="fw-bold text-secondary">Số ngày: </label>
                                <i class="fs-6 text-danger">{{ $data['tour']['number_of_day'] }}</i>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <label for="" class="fw-bold text-secondary">Nơi khởi hành: </label>
                                <i class="fs-6 text-danger fw-bold">{{ $data['tour']['province_start']['name'] }}</i>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <label for="" class="fw-bold text-secondary">Nơi đến: </label>
                                <i class="fs-6 text-danger fw-bold">{{ $data['tour']['province_end']['name'] }}</i>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <label for="" class="fw-bold text-secondary">Số lượng khách: </label>

                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Stt</th>
                                            <th scope="col">Loại</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Người lớn</td>
                                            <td>{{ number_format($data['order_detail']['price'], 0, ',', '.') }} đ</td>
                                            <td>x{{ $data['order_detail']['quantity'] }}</td>
                                            <td>{{ number_format($data['order_detail']['price'] * $data['order_detail']['quantity'], 0, ',', '.') }}
                                                đ</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Trẻ em</td>
                                            <td>{{ number_format($data['order_detail']['price_child'], 0, ',', '.') }}
                                                đ</td>
                                            <td>x{{ $data['order_detail']['quantity_child'] }}</td>
                                            <td>{{ number_format($data['order_detail']['price_child'] * $data['order_detail']['quantity_child'], 0, ',', '.') }}
                                                đ</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Em bé</td>
                                            <td>{{ number_format($data['order_detail']['price_baby'], 0, ',', '.') }} đ
                                            </td>
                                            <td>x{{ $data['order_detail']['quantity_baby'] }}</td>
                                            <td>{{ number_format($data['order_detail']['price_baby'] * $data['order_detail']['quantity_baby'], 0, ',', '.') }}
                                                đ</td>

                                        </tr>
                                        <tr class="table-primary">
                                            <th colspan="4">
                                                Tạm tính:
                                            </th>
                                            <th class="text-primary">
                                                {{ number_format($data['order']['subtotal'], 0, ',', '.') }} đ</th>
                                        </tr>
                                        <tr class="table-primary">
                                            <th colspan="4">
                                                Phụ thu:
                                            </th>
                                            <th class="text-primary">
                                                {{ number_format($data['order_detail']['additional_fee'], 0, ',', '.') }}
                                                đ</th>
                                        </tr>
                                        <tr class="table-success py-2">
                                            <th colspan="4" class="py-2">
                                                <div class="py-2">
                                                    Tổng tiền:
                                                </div>
                                            </th>
                                            <th>
                                                <div class="py-2">
                                                    {{ number_format($data['order']['total'], 0, ',', '.') }} đ
                                                </div>
                                            </th>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                    <div style="text-align: center" class="text-center text-secondary pt-4">Mọi thắc mắc vui lòng liên hệ tổng đài: <a
                            href="tel:+84358723520" class="text-danger mx-1">0358723520</a> để được giải đáp trực
                        tiếp!
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="position-fixed bottom-0 start-0 end-0">
        <div style="text-align: center;padding:5px" class="border-top py-2 text-center text-[12px]" style="color: gray; background-color:rgba(22,22,24,.12)">
            Copyright © 2024 Mr Quynh
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>



</body>

</html>
