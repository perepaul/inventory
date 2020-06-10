@extends('home')
@section('title','Inventories')
@section('content_header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Inventories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Inventories</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-right">

                    <a href="{{route('inventories.create')}}" class="btn btn-primary">Add Product</a>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-stripped table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th width="400px">Product Name</th>
                                <th>Quantity</th>
                                <th>Low stock alert</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td><img src="{{asset(config('constants.product_image_dir').'/'.$product->image)}}"
                                        alt="" class="img-responsive img-circle" srcset="" width="30" height="30"></td>
                                <td>
                                    {{$product->name}}
                                </td>
                                <td>{{$product->quantity}}</td>
                                <td> {{$product->alert_quantity}}</td>
                                <td>
                                    <a href="{{route('inventories.edit',$product->id)}}"
                                        class="btn btn-warning btn-sm">Edit <i class="fa fa-edit"></i> </a>
                                    <a href="{{route('inventories.destroy',$product->id)}}"
                                        class="btn btn-danger btn-sm">Delete <i class="fa fa-trash"></i>
                                    </a>
                                    <button class="btn btn-secondary btn-sm">Print Label <i
                                            class="fa fa-barcode"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="6">No products yet</td>
                            </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

@endsection
