@extends('home')

@section('title','Purchase - Report')
@section('content_header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Purchase report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Reports</li>
                    <li class="breadcrumb-item active">Inventories</li>
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
                    <div class="card-header">
                        <h3 class="card-title"> <b> Total Sales Report</b></h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-stripped table-hover">
                            <thead>
                                <tr>
                                    <th width="300px">Product</th>
                                    <th>Purchased by</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($purchases as $purchase)
                                <tr>
                                    <td>
                                        {{$purchase->product->name}}
                                    </td>
                                    <td>{{$purchase->user->name}}</td>
                                    <td>{{$purchase->quantity}}</td>
                                    <td> {{$purchase->price}}</td>
                                    <td>{{$purchase->created_at->format('d M, Y')}}</td>
                                    <td>
                                        <button onclick="getPurchase({{$purchase->id}})"
                                            class="btn btn-primary btn-sm"><i class="fa fa-eye text-sm"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6">No purchases yet</td>
                                </tr>
                                @endforelse

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
    function getPurchase(id)
        {
        $.ajax('purchase/'+id)
        .then(res => {
        $('#pur-product').val(res.data.product_name)
        $('#pur-price').val(res.data.price)
        $('#pur-quantity').val(res.data.quantity)
        $('#pur-comment').val(res.data.comment)
        $('#pur-user').val(res.data.user_name);
        $('#view-purchase').modal();
        },
        err=>{
        console.log(err)
        })
        }
</script>
@endsection
