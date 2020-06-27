@extends('adminlte::page')
@section('title',"Purchases")
@section('content_header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Products</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Purchase</li>
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

                    <button class="btn btn-primary" data-toggle="modal" data-target="#create-purchase">Add
                        Purchase</button>

                </div>
                <!-- /.card-header -->
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
                                    <button onclick="getPurchase({{$purchase->id}})" class="btn btn-primary btn-sm"><i
                                            class="fa fa-eye text-sm"></i></button>
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
            <!-- /.card -->


        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@include('purchase.modals')
@endsection
@section('load_js')
<script>
    $(function () {

        $('#product').autocomplete({
            serviceUrl: '{{route("sales.search")}}',
            type:'GET',
            dataType: 'json',
            paramName: 'q',
            minChars:2,
            onSearchStart: function(params){
                // $('#product').val(prams.label)
            },
            showNoSuggestionNotice: true,
            // triggerSelectOnValidInput:true,
            preventBadQueries:true,
            onSelect: function (suggestion) {
                // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
                $('#product_id').val(suggestion.data);

            }
        });
    })

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
