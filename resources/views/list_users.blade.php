@extends('layout')

@section('main')
<div class="bg-gray-50 text-black/50   container py-4">
    <div class="p-4 text-center fw-bold text-primary fs-4">Danh sách Người dùng</div>
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
                        <th scope="col">Full Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created_at</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr class="{{{$item->role !='admin' ? "" : "table-danger"}}}">
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->full_name }}</td>
                            <td><img src="{{  $item->avatar }}" alt=""
                                    width="42" class="img-fluid"></td>
                                    <th scope="row">{{ $item->email }}</th>
                                    <th scope="row">{{ $item->created_at }}</th>
                            
                          
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
<style>
    p.text-sm.text-gray-700.leading-5.dark\:text-gray-400 {
    display: none;
}
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="my-3 d-flex justify-content-center ">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection