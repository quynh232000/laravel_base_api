<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create Tour</title>




<style>
    *{
        box-sizing: inherit;
    }
    html,body{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    tr{
        border: 1px solid gray;
    }
    td,th{
        padding: 6px;
    }
</style>
</head>

<body style="padding: 10px;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
   
   <main>
        <div style="display: flex;justify-content: center;">
            <img src="https://quin.mr-quynh.com/assest/images/UNIDI_LOGO-FINAL%202.svg" alt="" width="96">
        </div>
        <div class="container pb-5 mb-5" style="max-width: 1200px; width: 100%; margin: auto;">
            <div class="row">
                <div class="col-mg-6 m-auto">
                    <div class="" style="padding: 16px 0;font-size: 16px;font-weight: bold;">Cảm ơn quý khách đã tin tưởng đặt Tour bên QuinTravel!</div>
                    <div style="border: 1px solid gray; padding: 10px;border-radius: 10px;">
                        <div style="font-weight: bold; color: green;">Thông tin khách hàng</div>
                        <div style="padding: 8px 0;">
                            <div style="display: flex; margin-bottom: 6px;" >
                                <div style="font-weight: bold; min-width: 80px;">Họ tên: </div>
                                <i class="fs-6 text-danger">{{ $data['order']['full_name'] }}</i>
                            </div>
                            <div style="display: flex; margin-bottom: 6px;">
                                <div style="font-weight: bold; min-width: 80px;">Email: </div>
                                <i class="fs-6 text-danger">{{ $data['order']['email'] }}</i>
                            </div>
                            <div style="display: flex; margin-bottom: 6px;">
                                <div style="font-weight: bold; min-width: 80px;">Số ĐT: </div>
                                <i class="fs-6 text-danger">{{ $data['order']['phone_number'] }}</i>
                            </div>
                            <div style="display: flex; ">
                                <div style="font-weight: bold; min-width: 80px;">Địa chỉ: </div>
                                <i class="fs-6 text-danger">{{ $data['order']['address'] }}</i>
                            </div>
                        </div>
                    </div>
                    <div style="border: 1px solid gray; margin: 10px 0; padding: 10px;border-radius: 10px;">
                        <div style="font-weight: bold; color: green;">Trạng thái thanh toán</div>
                        <div style="background-color: bisque; padding: 8px; text-align: center; margin-top: 6px;font-weight: bold;color: blue;" >
                            {{ $data['order']['payment_status'] == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</div>
                    </div>
                    <div style="padding: 10px;">
                        <div  style="font-weight: bold; color: green;">Chi tiết đơn hàng đơn hàng</div>
                        <div class=" border-2 border-warning p-4 rounded-3"
                            style="background-color: rgba(193, 193, 235, 0.12)">
                            <div style="display: flex; margin-bottom: 8px;">
                                <div style="font-weight: bold; min-width: 80px;">Địa điểm: </div>
                                <i class="fs-6 text-primary fw-bold">{{ $data['tour']['title'] }}</i>
                            </div>

                            <div class="d-flex gap-2 mb-2 justify-content-center">
                                <img style="width: 100%; object-fit: cover;margin: 10px 0;" class="img-fluid rounded-4"
                                    src="{{$data['tour']['thumnail']}}" alt="">
                            </div>

                            <div style="display: flex; margin-bottom: 8px;">
                                <div style="font-weight: bold; min-width: 120px;">Ngày đặt: </div>
                                <i class="fs-6 text-danger">{{ $data['order']['created_at'] }}</i>
                            </div>
                            <div style="display: flex; margin-bottom: 8px;">
                                <div style="font-weight: bold; min-width: 120px;">Ngày khởi hành: </div>
                                <i class="fs-6 text-danger">{{ $data['tour']['date_start'] }}</i>
                            </div>
                            <div style="display: flex; margin-bottom: 8px;">
                                <div style="font-weight: bold; min-width: 120px;">Số ngày: </div>
                                <i class="fs-6 text-danger">{{ $data['tour']['number_of_day'] }}</i>
                            </div>
                            <div style="display: flex; margin-bottom: 8px;">
                                <div style="font-weight: bold; min-width: 120px;">Nơi khởi hành: </div>
                                <i class="fs-6 text-danger fw-bold">{{ $data['tour']['province_start']['name'] }}</i>
                            </div>
                            <div style="display: flex; margin-bottom: 8px;">
                                <div style="font-weight: bold; min-width: 120px;">Nơi đến: </div>
                                <i class="fs-6 text-danger fw-bold">{{ $data['tour']['province_end']['name'] }}</i>
                            </div>
                            <div style="display: flex; margin-bottom: 8px;">
                                <div style="font-weight: bold; min-width: 120px;">Số lượng khách: </div>

                            </div>
                            <div>
                                <table style="border: 1px solid gray;width: 100%;border-radius: 5px;border-collapse: collapse;">
                                    <thead>
                                        <tr class="border-bottom:1px solid gray">
                                            <th scope="col">Stt</th>
                                            <th scope="col">Loại</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Người lớn</td>
                                            <td>{{ number_format($data['order_detail']['price'], 0, ',', '.') }} đ</td>
                                            <td>x{{ $data['order_detail']['quantity'] }}</td>
                                            <td>{{ number_format($data['order_detail']['price'] * $data['order_detail']['quantity'], 0, ',', '.') }}
                                                đ</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Trẻ em</td>
                                            <td>{{ number_format($data['order_detail']['price_child'], 0, ',', '.') }} đ</td>
                                            <td>x{{ $data['order_detail']['quantity_child'] }}</td>
                                            <td>{{ number_format($data['order_detail']['price_child'] * $data['order_detail']['quantity_child'], 0, ',', '.') }}
                                                đ</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Em bé</td>
                                            <td>{{ number_format($data['order_detail']['price_baby'], 0, ',', '.') }} đ</td>
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
                    <div style="text-align: center;padding-top: 10px;margin-top: 10px;color: gray;font-size: 14px;" >Mọi thắc mắc vui lòng liên hệ tổng đài: <a
                            href="tel:+84358723520" class="text-danger mx-1">0358723520</a> để được giải đáp trực
                        tiếp!
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer >
        <div style="text-align: center;padding:5px;color: gray; background-color:rgba(22,22,24,.12);padding: 6px;" >
            Copyright © 2024 Mr Quynh
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>



</body>

</html>
