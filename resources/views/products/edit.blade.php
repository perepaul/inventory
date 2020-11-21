@extends('adminlte::page')
@section('title','Edit Inventory')
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
                    <li class="breadcrumb-item active">Update Inventory</li>
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
                        <h3 class="card-title">Update Inventory</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('inventories.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="#">SKU</label>
                                <input type="text" class="form-control" id="" placeholder="SKU" name="sku" value="{{$product->sku}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="#">Product Name</label>
                                <input type="text" class="form-control" id="" placeholder="Product Name" name="name" value="{{$product->name}}">
                            </div>

                            <!-- <div class="form-group col-md-6">
                                <label for="#">Stock Quantity</label>
                                <input type="text" class="form-control" id="" placeholder="Total Prodct" name="quantity"
                                    value="{{old('quantity')}}">
                            </div> -->

                            <div class="form-group col-md-6">
                                <label for="#">Description</label>
                                <input type="text" class="form-control" id="" placeholder="description" name="description" value="{{$product->description}}">
                            </div>

                            <div class="form-group  col-md-2 pl-2">
                                @include('partials.status',['checked'=>$product->status,'name'=>'status',
                                'on'=>'Enable','off'=>'Disable'])

                            </div>

                            <div class="form-group col-md-4">
                                <label for="#">Product Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>

                                </div>
                            </div>


                            <hr class="w-100 border-top">

                            <section>

                                <div class="row col-12">
                                    <div class="form-group col-md-2">
                                        <label for="#">Unit</label>
                                        <input required type="text" class="form-control" id="price" placeholder="Quantity" name="" value="Pieces" readonly disabled>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="#">retail price</label>
                                        <input required type="text" class="form-control" id="price" placeholder="retail price" name="pieces_retail_price" value="{{$product->pieces_retail_price}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="#">wholesale price</label>
                                        <input required type="text" class="form-control" id="price" placeholder="wholesale price" name="pieces_wholesale_price" value="{{$product->pieces_wholesale_price}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="#">cost price</label>
                                        <input required type="text" class="form-control" id="price" placeholder="cost price" name="pieces_cost_price" value="{{$product->pieces_cost_price}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="#">quantity</label>
                                        <input required type="text" class="form-control" id="price" placeholder="quantity" name="pieces_stock" value="{{$product->pieces_stock}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="#">alert quantity</label>
                                        <input required type="text" class="form-control" id="price" placeholder="Low Stock" name="pieces_alert_quantity" value="{{$product->pieces_alert_quantity}}">
                                    </div>

                                </div>
                                <hr class="w-100 border-top">
                            </section>

                            <section>

                                <div class="row col-12">
                                    <div class="form-group col-md-2">
                                        <label for="#">Unit</label>
                                        <input type="text" class="form-control" id="price" placeholder="Quantity" name="" value="Carton" readonly disabled>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="#">retail price</label>
                                        <input type="text" class="form-control" id="price" placeholder="retail price" name="carton_retail_price" value="{{$product->carton_retail_price}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="#">wholesale price</label>
                                        <input type="text" class="form-control" id="price" placeholder="wholesale price" name="carton_wholesale_price" value="{{$product->carton_wholesale_price}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="#">cost price</label>
                                        <input type="text" class="form-control" id="price" placeholder="cost price" name="carton_cost_price" value="{{$product->carton_cost_price}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="#">quantity</label>
                                        <input type="text" class="form-control" id="price" placeholder="quantity" name="carton_stock" value="{{$product->carton_stock}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="#">alert quantity</label>
                                        <input type="text" class="form-control" id="price" placeholder="Low Stock" name="carton_alert_quantity" value="{{$product->carton_alert_quantity}}">
                                    </div>

                                </div>
                                <hr class="w-100 border-top">
                            </section>

                            <!-- <div class="form-group col-md-6">
                                <label for="#">Purchse Price (per quantity)</label>
                                <input type="text" class="form-control" id="" placeholder="Quantity"
                                    name="purchase_price" value="{{old('purchase_price')}}">
                            </div> -->

                            <!-- <div class="form-group col-md-6">
                                <label for="#">Selling Price (per quantity)</label>
                                <input type="text" class="form-control" id="price" placeholder="Quantity" name="price"
                                    value="{{old('price')}}">
                            </div> -->
                            <!-- <div class="form-group col-md-5">
                                <label for="#">Discount Amount</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Discount price" name="discount" value="{{old('discount')}}">
                            </div> -->





                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-success float-right">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>
</section>



@endsection
@section('load_js')
<script>
    $(function() {
        $(document).on('click', '.remove-unit', function() {
            $.get($(this).data('url'))
                .then((res) => {
                        notify('Unit removed!')
                        $(this).parent().remove();
                    },
                    (err) => {

                    })
        })
    })
</script>

@endsection