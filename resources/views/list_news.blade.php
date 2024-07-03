@extends('layout')

@section('main')
<div class="bg-gray-50 text-black/50   container py-4">
    <div class="p-4 text-center fw-bold text-primary fs-4">Danh sách Tin tức</div>
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
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col" class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $item)
                        <tr class="{{{$item->is_show ? "" : "table-danger"}}}">
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->title }}</td>
                            <td><img src="{{  $item->thumbnail }}" alt=""
                                    width="42" class="img-fluid"></td>
                            
                            <td>
                                <div class="d-flex justify-content-end gap-2">

                                    @if ($item->is_show)
                                        <a style="min-width: 54px" class="btn btn-sm btn-warning"
                                            href="{{ url('/news/hidden/' . $item->id) }}">Ẩn</a>
                                    @else
                                        <a style="min-width: 54px" class="btn btn-sm btn-success"
                                            href="{{ url('/news/show/' . $item->id) }}">Hiện</a>
                                    @endif
                                    <a style="min-width: 54px" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Xóa hả')"
                                        href="{{ url('/news/delete/' . $item->id) }}">Xóa</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="my-3 d-flex justify-content-center ">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</div>
@endsection