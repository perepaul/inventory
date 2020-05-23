@extends('home')


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
    <div  class="container-fluid ">
        <div class="card card-secondary">
            <div class="card-body">
                <div class="col-md-12">
                    <form action="#">

                        <div  class="row">

                            <div class="col-md-8">
                                <div class="input-group input-group-md">
                                    <input type="text" class="form-control" placeholder="Search For Name / SKU / O  r Scan Code">
                                    <span class="input-group-append">
                                    <button type="button" class="btn btn-info btn-flat">Search</button>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-4">

                                <img class="img-responsive" src="https://via.placeholder.com/100" alt="Logo" srcset="">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-8">

                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price ₦</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>
                                        Quantity Here
                                        </td>
                                        <td>₦</td>
                                        <td>
                                        <button class="btn btn-success"><i class="fa fa-plus"></i> </button>
                                        <button class="btn btn-danger"><i class="fa fa-minus"></i> </button>
                                        </td>
                                    </tr>
                                    
                                    </tbody>
                            
                                    </table>
                                </div>

                            </div>
                    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="#">Total Quantity</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Total Quantity">
                                </div>

                                <div class="form-group">
                                    <label for="#">Discount %</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Discount Price">
                                </div>

                                <div class="form-group">
                                    <label for="#">Total</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Total ">
                                </div>

                                <button class="btn btn-success">Checkout </button>

                            </div>

                        </div>
                    </form>
            </div>

            </div>
        </div>
    </div>
</section>
    
@endsection