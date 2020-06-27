@extends('home')

@section('title','Inventory - Report')
@section('content_header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Inventory report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Reports</li>
                    <li class="breadcrumb-item active">Inventory</li>
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
            <div class="col-md-12">
                @include('partials.report-filter')
            </div>

            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header bg-success">
                        <div class="d-flex justify-content-between">
                            <div class="card-title"> <b> Active products</b></div>
                            <div class="text-sm mt-2" data-toggle="collapse" data-target="#active_product_toggle">
                                <span><i class="fa fa-minus toggle-handle"></i></span></div>
                        </div>
                    </div>
                    <div id="active_product_toggle" class="collapse show">
                        <div class="card-body">
                            <table class="table table-hover table-striped" data-page-length="10"
                                data-language='{"zeroRecords":"No inventory found!"}'>
                                <thead>
                                    <tr>
                                        <th class="no-sort">sku</th>
                                        <th class="no-sort">&nbsp;</th>
                                        <th>Product</th>
                                        <th>quantity</th>
                                        <th>Alert Qty</th>
                                        <th class="no-sort">Price</th>
                                        <th class="no-sort">Purchase Price</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($active_products as $product)
                                    <tr>
                                        <td>{{$product->sku}}</td>
                                        <td><img src="{{asset(config('constants.product_image_dir').'/'.$product->image)}}"
                                                alt="Product Image" width="30"></td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td> {{$product->alert_quantity}}</td>
                                        <td>{{format_currency($product->price,true)}}</td>
                                        <td>{{format_currency($product->purchase_price,true)}}</td>
                                        <td>{{$product->created_at->format('d M, Y')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"> <b> Deactivated products</b></h3>
                            <div class="text-sm mt-2" data-toggle="collapse" data-target="#deactivated_products">
                                <span><i class="fa fa-minus toggle-handle"></i></span></div>
                        </div>
                    </div>
                    <div class="card-body collapse show" id="deactivated_products">
                        <table class="table table-striped table-hover" data-page-length="10"
                            data-language='{"zeroRecords":"No inventory found!"}'>
                            <thead>
                                <tr>
                                    <th class="no-sort">sku</th>
                                    <th class="no-sort">&nbsp;</th>
                                    <th>Product</th>
                                    <th>quantity</th>
                                    <th>Alert Qty</th>
                                    <th class="no-sort">Price</th>
                                    <th class="no-sort">Purchase Price</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($disabled_products as $product)
                                <tr>
                                    <td>{{$product->sku}}</td>
                                    <td><img src="{{asset(config('constants.product_image_dir').'/'.$product->image)}}"
                                            alt="Product Image" width="30"></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td> {{$product->alert_quantity}}</td>
                                    <td>{{format_currency($product->price,true)}}</td>
                                    <td>{{format_currency($product->purchase_price,true)}}</td>
                                    <td>{{$product->created_at->format('d M, Y')}}</td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header bg-success">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"><i class="fas fa-chart-line"></i><strong> Best Selling 5
                                    inventories</strong></h3>
                            <div class="text-sm mt-2" data-toggle="collapse" data-target="#best_five_products">
                                <span><i class="fa fa-minus toggle-handle"></i></span></div>
                        </div>
                    </div>
                    <div class="card-body collapse show" id="best_five_products">
                        <table class="table table-striped table-hover" data-page-length="5"
                            data-language='{"zeroRecords":"No inventory found!"}' data-ordering="false"
                            data-searching="false" data-paging="false" data-info="false">
                            <thead>
                                <tr>
                                    <th class="no-sort">sku</th>
                                    <th class="no-sort">&nbsp;</th>
                                    <th>Product</th>
                                    <th>Total Sold</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($best_selling as $bs)
                                <tr>
                                    <td>{{$bs['product']->sku}}</td>
                                    <td><img src="{{asset(config('constants.product_image_dir').'/'.$bs['product']->image)}}"
                                            alt="Product Image" width="30">
                                    </td>
                                    <td>{{$bs['product']->name}}</td>
                                    <td>{{$bs['total_sold']}}</td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header bg-danger">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"><i class="fas fa-exclamation-triangle"></i><strong> Low stock
                                    products</strong></h3>
                            <div class="text-sm mt-2" data-toggle="collapse" data-target="#low_stock_products">
                                <span><i class="fa fa-minus toggle-handle"></i></span></div>
                        </div>
                    </div>
                    <div class="card-body collapse show" id="low_stock_products">
                        <table class="table table-striped table-hover" data-page-length="5"
                            data-language='{"zeroRecords":"No inventory found!"}' data-ordering="false"
                            data-searching="false" data-paging="false" data-info="false">
                            <thead>
                                <tr>
                                    <th class="no-sort">sku</th>
                                    <th class="no-sort">&nbsp;</th>
                                    <th>Product</th>
                                    <th>quantity</th>
                                    <th>Alert Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($low_stock_products as $product)
                                <tr>
                                    <td>{{$product->sku}}</td>
                                    <td><img src="{{asset(config('constants.product_image_dir').'/'.$product->image)}}"
                                            alt="Product Image" width="30">
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td> {{$product->alert_quantity}}</td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('load_js')
<script>
    $(function() {
        $('.table').DataTable({
            responsive:true
        });
        removeSort();
        $(document).on('click','thead',function(){
            removeSort();
        })
    })

    function removeSort()
    {
        $('.no-sort').removeClass(function(){
        return 'sorting sorting_asc sorting_desc';
        })
    }
</script>
@endsection
