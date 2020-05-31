@extends('adminlte::page')

@section('title','Sales')

@section('content_header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <b> Sales</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Sell Product</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection


@section('content')

<section class="content">
    <div class="container-fluid ">
        <div class="card card-secondary">
            <div class="card-body">
                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-8 offset-md-2 mb-5">
                            <input type="text" class="form-control" placeholder="Search By Name, Sku  or Scan Code">
                        </div>

                        <div class="col-md-9">

                            <table id="example2" class="table table-stiped table-md w-100 pr-5 v-align-middle"
                                style="border-bottom:1px solid #dee2e6;">
                                <thead class="bg-teal">
                                    <tr>
                                        <th width="250px">Name</th>
                                        <th width="160px">Quantity</th>
                                        <th>Price </th>
                                        <th width="120px">Discount</th>
                                        <th>Total</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    <tr>
                                        <td class="p-2" style="vertical-align:middle;">Name</td>
                                        <td class="p-2" style="vertical-align:middle;">
                                            @include('partials.select')
                                        </td>
                                        <td class="p-2" style="vertical-align:middle;">₦300000</td>
                                        <td class="p-2" style="vertical-align:middle;"><input type="text"
                                                name="discount" class="form-control"></td>
                                        <td class="p-2" style="vertical-align:middle;">₦30000</td>
                                        <td class="p-2" style="vertical-align:middle;"><button
                                                class=" btn btn-danger btn-sm text-sm">&times;</i></button></td>
                                    </tr>
                                    {{-- <tr>
                                        <td colspan="5" class="text-center">Nothing Here!</td>
                                    </tr> --}}

                                </tbody>

                            </table>

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="#">Total Quantity</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Total Quantity">
                            </div>

                            <div class="form-group">
                                <label for="#">Discount %</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    placeholder="Discount Price">
                            </div>

                            <div class="form-group">
                                <label for="#">Total</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Total ">
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-success">Checkout </button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
