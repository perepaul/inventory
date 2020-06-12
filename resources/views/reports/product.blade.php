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
    <div  class="container-fluid ">
        <div  class="row">
            <div class="col-md-12">
                @include('partials.report-filter')
            </div>

            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title"> <b> Active products</b></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>sku</th>
                            <th>&nbsp;</th>
                            <th>Product</th>
                            <th>quantity</th>
                            <th>Alert Qty</th>
                            <th>Price</th>
                            <th>Purchase Price</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($active_products as $product)
                                <tr>
                                    <td>{{$product->sku}}</td>
                                    <td><img src="{{asset(config('constants.product_image_dir').'/'.$product->image)}}" alt="Product Image" width="30"></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td> {{$product->alert_quantity}}</td>
                                    <td>{{format_currency($product->price,true)}}</td>
                                    <td>{{format_currency($product->purchase_price,true)}}</td>
                                    <td>{{$product->created_at->format('d M, Y')}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8"><span class="text-muted text-center">No Active Products <a href="{{route('inventories.create')}}"></a></span></td>
                                </tr>
                            @endforelse
                        </tbody>

                        </table>
                    </div>
                            <div class="d-flex justify-content-center">
                                {{$active_products->links()}}
                            </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title"> <b> Deactivated products</b></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripe table-hover">
                        <thead>
                            <tr>
                                <th>sku</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>quantity</th>
                                <th>Alert Qty</th>
                                <th>Price</th>
                                <th>Purchase Price</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($disabled_products as $product)
                            <tr>
                                <td>{{$product->sku}}</td>
                                <td><img src="{{asset(config('constants.product_image_dir').'/'.$product->image)}}" alt="Product Image" width="30"></td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->quantity}}</td>
                                <td> {{$product->alert_quantity}}</td>
                                <td>{{format_currency($product->price,true)}}</td>
                                <td>{{format_currency($product->purchase_price,true)}}</td>
                                <td>{{$product->created_at->format('d M, Y')}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-muted text-center">No Deactivated Products @if(auth()->user()->isAbleTo('create-inventory'))<a href="{{route('inventories.create')}}">click here to create</a>@endif</td>
                            </tr>
                        @endforelse

                        </tbody>

                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{$active_products->links()}}
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Low stock products</strong></h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Sales Date</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Total Invoice</th>
                            <th>Total Sale For The Day</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Here</td>
                            <td>
                            Here
                            </td>
                            <td>Here</td>
                            <td> Here</td>
                            <td>Here</td>
                            <td>
                            Here
                            </td>
                        </tr>

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
