@extends('layouts.app')
@section('style')

@endsection
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product List</h1>
                </div>
                <div class="col-sm-6">
                    <div class="breadcrumb float-sm-right">
                        <a href="{{ url('shop_manager/product/add') }}" class="btn btn-primary">เพิ่มสินค้า</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @include('_message')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">สินค้า</h3>
                </div>
                <div class="card-body p-0">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รูป</th>
                                <th>ชื่อ</th>
                                <th>slug</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>
                                    @if(!empty($value->images))
                                        <img src="{{ $value->images[0]->src }}" alt="{{ $value->images[0]->alt }}" width="40" height="40">
                                    @else
                                    No Image
                                    @endif
                                </td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $product->slug ?? '-' }}</td>
                                <td>
                                    {{ $value->regular_price }}
                                    <br>
                                    {{$value->sale_price}}
                                </td>
                                <td>{{ $value->stock_quantity }}</td>
                                <td>{{ $value->stock_status }}</td>
                                <td>
                                    <a href="{{ url('admin/product/edit/' . $value->id) }}" class="btn btn-primary ">Edit</a>
                                    <a href="{{ url('admin/product/delete/' . $value->id) }}" class="btn btn-danger ">Detele</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-3 float-right">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')

@endsection