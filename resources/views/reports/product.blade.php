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
            {{-- <div class="col-md-12">
                @include('partials.report-filter')
            </div> --}}
        <div class="row col-md-12">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-gift"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Products</span>
                <span class="info-box-number">
                    {{$total_products}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Active Products</span>
                <span class="info-box-number">{{$total_active_products}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-times"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">In-active Products</span>
                <span class="info-box-number">{{$total_inactive_products}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-exclamation-triangle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Low Stock</span>
                <span class="info-box-number">{{$low_stock_count}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header bg-info">
                        <div class="d-flex justify-content-between">
                            <div class="card-title"> <b> Active products</b></div>
                            <div class="text-sm mt-2" data-toggle="collapse" data-target="#active_product_toggle">
                                <span><i class="fa fa-minus toggle-handle"></i></span></div>
                        </div>
                    </div>
                    <div id="active_product_toggle" class="collapse show">
                        <div class="card-body">
                            <table class="table table-sm table-hover table-striped" data-page-length="10"
                                data-language='{"zeroRecords":"No inventory found!"}'>
                                <thead>
                                    <tr>
                                        {{-- <th class="no-sort">sku</th> --}}
                                        <th class="no-sort">&nbsp;</th>
                                        <th>Product</th>
                                        <th>quantity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($active_products as $product)
                                    <tr>
                                        {{-- <td>{{$product->sku}}</td> --}}
                                        <td><img src="{{asset(config('constants.product_image_dir').'/'.$product->image)}}"
                                                alt="Product Image" width="30"></td>
                                        <td>{{$product->name}}</td>
                                        <td>{{number_format($product->pieces_stock)}}(pcs)<br>{{number_format($product->carton_stock)}}(ctn) </td>
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

            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title"> <b> Deactivated products</b></h3>
                            <div class="text-sm mt-2" data-toggle="collapse" data-target="#deactivated_products">
                                <span><i class="fa fa-minus toggle-handle"></i></span></div>
                        </div>
                    </div>
                    <div class="card-body collapse show" id="deactivated_products">
                        <table class="table table-sm table-striped table-hover" data-page-length="10"
                            data-language='{"zeroRecords":"No inventory found!"}'>
                            <thead>
                                <tr>
                                    {{-- <th class="no-sort">sku</th> --}}
                                    <th class="no-sort">&nbsp;</th>
                                    <th>Product</th>
                                    <th>quantity</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($disabled_products as $product)
                                <tr>
                                    {{-- <td>{{$product->sku}}</td> --}}
                                    <td><img src="{{asset(config('constants.product_image_dir').'/'.$product->image)}}"
                                            alt="Product Image" width="30"></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{number_format($product->pieces_stock)}}(pcs)<br>{{number_format($product->carton_stock)}}(ctn) </td>
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
                    <div class="card-header bg-warning">
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
                                    {{-- <th class="no-sort">sku</th> --}}
                                    <th class="no-sort">&nbsp;</th>
                                    <th>Product</th>
                                    <th>Low on</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($low_stock_products as $product)
                                <tr>
                                    {{-- <td>{{$product->sku}}</td> --}}
                                    <td><img src="{{asset(config('constants.product_image_dir').'/'.$product->image)}}"
                                            alt="Product Image" width="30">
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>
                                        {{$product->pieces_stock <= $product->pieces_alert_quantity ? "pieces":''}}
                                        {{$product->carton_stock <= $product->carton_alert_quantity ? " & carton":''}}
                                    </td>
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
