@extends('layout')

@section('main')
<div class="">
    <section class="h-100 gradient-form pt-5" style="background-color: #eee; min-height:100vh">
        <div class="container py-5 h-100 bg-light p-4 rounded-4">

            <div>

                @if (session('successMess'))
                    <div class="alert alert-success">
                        {{ session('successMess') }}
                    </div>
                @endif



                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    @if (session('errorMess'))
                        <div class="alert alert-danger">
                            {{ session('errorMess') }}
                        </div>
                    @endif
                @endif

            </div>
            <h2 class="text-center py-2">Tạo tour mới</h2>
            <form method="post" id="form-create" action="{{ route('create_') }}" class="row"
                enctype="multipart/form-data">

                @csrf
                <div class="col-md-7 ">
                    <div>
                        <div class="mb-2">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" value="{{ old('title') }}" class="form-control" id="title"
                                name="title">
                        </div>

                        <div class="mb-2">
                            <label for="thumnail" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" id="thumnail" name="thumnail">
                        </div>
                        <div class="mb-2">
                            <label for="images" class="form-label">Images (max4)</label>
                            <input type="file" multiple class="form-control" id="images" name="images[]">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="title" class="form-label">Type</label>
                                    <select name="type" class="form-control" id="">
                                        <option value="">--Select--</option>
                                        <option value="inside" selected>Trong nước</option>
                                        <option value="ouside">Nước ngoài</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="title" class="form-label">Category</label>
                                    <select name="category" class="form-control" id="">
                                        <option value="">--Select--</option>
                                        <option value="tour" selected>Tour du lịch</option>
                                        <option value="hotel">Khách sạn</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label for="price" class="form-label">Giá</label>
                                    <input type="number" value="{{ old('price') }}" class="form-control"
                                        id="price" name="price">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label for="price_child" class="form-label">Giá trẻ em</label>
                                    <input type="number" value="{{ old('price_child') }}" class="form-control"
                                        id="price_child" name="price_child">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label for="price_baby" class="form-label">Giá baby</label>
                                    <input type="number" value="{{ old('price_baby') }}" class="form-control"
                                        id="price_baby" name="price_baby">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="percent_sale" class="form-label">Giảm giá (%)</label>
                                    <input type="number" class="form-control" value="0" id="percent_sale"
                                        name="percent_sale">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="additional_fee" class="form-label">Phí phụ thu</label>
                                    <input type="number" class="form-control" value="0" id="additional_fee"
                                        name="additional_fee">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label for="title" class="form-label">Nước</label>
                                    <select name="country_id" class="form-control" id="">
                                        <option value="">--Select--</option>
                                        @foreach ($countries as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == '232' ? 'selected' : '' }}>{{ $item->nicename }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label for="title" class="form-label">Tỉnh bắt đầu</label>
                                    <select name="province_start_id" class="form-control" id="">
                                        <option value="">--Chọn--</option>
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label for="title" class="form-label">Tỉnh kết thúc</label>
                                    <select name="province_end_id" class="form-control" id="">
                                        <option value="">--Chọn--</option>
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-md-5">
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="number_of_day" class="form-label">Số ngày đi</label>
                                    <input type="number" class="form-control" id="number_of_day"
                                        name="number_of_day" value="1" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="description" class="form-label">Dòng tour</label>
                                    <select name="tour_pakage" class="form-control" id="">
                                        <option value="">--Select--</option>
                                        <option value="luxury">Cao cấp</option>
                                        <option value="standard" selected>Tiêu chuẩn</option>
                                        <option value="affordable">Giá tốt</option>
                                        <option value="saving">Tiết kiệm</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-2">
                                    <label for="quantity" class="form-label">Số lượng vé</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        value="10" />
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="number_of_day" class="form-label">Transportation</label>
                                    <select name="transportation" class="form-control" id="">
                                        <option value="">--Select--</option>
                                        <option value="airplane" selected>Máy bay</option>
                                        <option value="car">Ô tô</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-2">
                                    <label for="date_start" class="form-label">Ngày khởi hành</label>
                                    <input class="form-control" type="date" id="date_start"
                                        name="date_start" />
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="time_start" class="form-label">Giờ khởi hành</label>
                                    <input class="form-control" type="text" id="time_start" value="08:30"
                                        name="time_start" />
                                </div>
                            </div>

                        </div>

                        <div class="fw-bold py-2 mb-2 bg-secondary text-white px-2 d-flex justify-content-between">
                            <div>Process Tour</div>
                            <div class="btn btn-sm btn-info" id="btn-add">Thêm</div>
                        </div>
                        <div id="process_detail">
                            {{-- <div class="border p-2 border-primary mb-2">
                                <div class="mb-2">
                                    <label class="fw-bold" for="">Ngày <span></span></label>
                                    <input type="date" name="date[]" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="fw-bold" for="">Tiêu đề <span></span></label>
                                    <input type="date" name="title_process[]" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label class="fw-bold" for="">Content <span></span></label>
                                    <div id="editor"  style="min-height: 60px">
                                    
                                    </div>
                                </div>
                                <input type="text" name="content[]" hidden>
                            </div> --}}




                        </div>
                        <div class="row pt-4 px-3">
                            <button type="submit" class="col-md-12 btn btn-primary w-100">
                                Tạo
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </section>
</div>
@endsection


@push('js')
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
@endpush