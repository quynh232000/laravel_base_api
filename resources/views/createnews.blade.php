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
                <h2 class="text-center py-2">Tạo tin mới</h2>
                <form method="post" id="form-create" action="{{ route('create_news_') }}" class="row"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12">
                        <div>
                            <div class="row">
                                <div class="col-md-6 m-auto">
                                    <div class="mb-2">
                                        <label for="title" class="form-label fw-bold">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 m-auto">
                                    <div class="mb-2">
                                        <label for="thumbnail" class="form-label fw-bold">Thumbnail</label>
                                        <input type="file" class="form-control" id="thumbnail" name="thumbnail" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6 m-auto">
                                    <div class="mb-2">
                                        <label for="number_of_day" class="form-label fw-bold">Category</label>
                                        <input type="text" class="form-control" name="category"
                                            value="{{ old('category') ? old('category') : 'travel' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6 m-auto">
                                    <div class="mb-2">
                                        <label for="number_of_day" class="form-label fw-bold">Content</label>
                                        <div>
                                            <div id="editor" style="min-height: 230px">{!! old('content') !!}</div>
                                            <input value="{{old('content')}}" type="text" name="content" id="content" hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-4 px-3 pb-5 mb-5">
                                <div class="col-md-4 m-auto">
                                    <button type="submit" class="  btn btn-primary w-100">
                                        Tạo tin mới
                                    </button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </section>
    </div>
@endsection


@push('js')
    <script>
        new Quill('#editor', {
            theme: 'snow'
        });
        // submit form 
        $("#form-create").on('submit', function(e) {
           
            $("#content").val($('#editor').html());

        })
    </script>
@endpush
