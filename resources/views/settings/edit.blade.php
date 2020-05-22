@extends('adminlte::page')
@section('title','Settings')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Settings</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Settings</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection


@section('content')

<section class="content">
    <div class="container">
        <!-- SELECT2 EXAMPLE -->
        <div class="card container">
            <div class="card-header">
                <h2 class="card-title">App Settings</h2>
            </div>
            <!-- /.card-header -->
            <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Title</label>
                                <select name="title" id="title" class="form-control">
                                    <option value="">Choose Title</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Mr.">Mr. </option>
                                    <option value="Mrs.">Mrs. </option>
                                    <option value="Miss.">Miss. </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Owner First Name</label>
                                <input type="text" name="firstname" class="form-control" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Owner Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Business Name</label>
                                <input type="text" name="bussiness_name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Business name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="#">Currency</label>
                                <select class="form-control" name="currency_text" id="">
                                    <option value="">Choose Currency</option>
                                    <option value="NGN">NGN</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="#">Currency symbol</label>
                                <select class="form-control" name="currency_sym" id="">
                                    <option value="">Currency Symbol</option>
                                    <option value="₦">₦</option>
                                    <option value="$">$</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Business Phone No</label>
                                <input type="text" name="phone_1" class="form-control" placeholder="Business No:">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Alternate Phone No</label>
                                <input type="number" name="phone_2" class="form-control" placeholder="Alertnate No:">
                            </div>
                        </div>
                        <div style="margin-top: 32px;" class="col-md-4">
                            <div class="form-group">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Upload Logo</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="#">Address</label>
                                <textarea name="address" id="address" cols="30" rows="2" class="form-control"
                                    placeholder="Enter address"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" name="country" class="form-control" placeholder="Country:">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">State / Province</label>
                                <input type="text" name="state" class="form-control" placeholder="State:">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">City / Town</label>
                                <input type="text" name="city" class="form-control" placeholder="City:">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Zip Code</label>
                                <input type="text" name="zip" class="form-control" placeholder="ZipCode:">
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card-footer col-md-12 bg-white ">
                    <button type="submit" class="btn btn-success btn-md float-right">Submit</button>
                </div>
            </form>
        </div>
</section>


@endsection
