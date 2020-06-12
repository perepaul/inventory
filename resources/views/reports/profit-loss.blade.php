@extends('home')
@section('title','Profit & loss - Report')

@section('content_header')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profit & loss report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Reports</li>
                    <li class="breadcrumb-item active">Profit & loss</li>
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
                        <h3 class="card-title"> <b> Total Sales Report</b></h3>
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
