@extends('layout')

@section('main')
    <div class="bg-gray-50 text-black/50   container py-4">
        <div class="p-4 text-center fw-bold text-primary fs-4">Danh sách Tours</div>
        <div class="row">
            <div class="col-md-12">
                <div>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="table-warning">
                            <th scope="col">Id</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>

                                <td><img src="{{ $item->order_detail[0]->product->thumnail }}" alt="" width="42"
                                        class="img-fluid"></td>
                                <td style="max-width: 260px">{{ $item->order_detail[0]->product->title }}</td>
                                <td>{{ $item->email }}</td>
                                <td class="{{ $item->payment_status ? 'text-success' : 'text-info' }} fw-bold">
                                    {{ $item->payment_status ? 'Đã thanh toán' : 'Chưa thanh toán' }}</td>
                                <td>{{ (new DateTime($item->created_at))->format('Y/m/d') }}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
        <style>
            span.relative.z-0.inline-flex.rtl\:flex-row-reverse.shadow-sm.rounded-md {
                display: none !important;
            }

            p.text-sm.text-gray-700.leading-5.dark\:text-gray-400 {
                display: none !important;
            }
        </style>
        <div class="row">
            <div class="col-md-12">
                <div class="my-3 d-flex justify-content-center ">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
