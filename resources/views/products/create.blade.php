@extends('adminlte::page')
@section('title','Create Inventory')
@section('content_header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <b> PRODUCT</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('inventories.index')}}">Product</a></li>
                    <li class="breadcrumb-item active">Create Product</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection


@section('content')

<section class="content">
    <div class="container-fluid ">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Create Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('inventories.store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="#">SKU</label>
                                <input type="text" class="form-control" id="" placeholder="SKU" name="sku"
                                    value="{{old('sku')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="#">Product Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Product Name" name="name" value="{{old('name')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="#">Stock Quantity</label>
                                <input type="text" class="form-control" id="" placeholder="Total Prodct" name="quantity"
                                    value="{{old('quantity')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="#">Stock Alert Quantity</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Alert Quantity" name="alert_quantity"
                                    value="{{old('alert_quantity')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="#">Purchse Price (per quantity)</label>
                                <input type="text" class="form-control" id="" placeholder="Quantity"
                                    name="purchase_price" value="{{old('purchase_price')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="#">Selling Price (per quantity)</label>
                                <input type="text" class="form-control" id="price" placeholder="Quantity" name="price"
                                    value="{{old('price')}}">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="#">Discount Amount</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Discount price" name="discount" value="{{old('discount')}}">
                            </div>
                            <div class="form-group  col-md-2 pl-2  w-100">
                                @include('partials.status',['checked'=>true,'name'=>'status',
                                'on'=>'Enable','off'=>'Disable'])

                            </div>
                            <div class="form-group col-md-5">
                                <label for="#">Product Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>
</section>



@endsection
