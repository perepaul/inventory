@extends('adminlte::page')
@section('title','Create Unit')
@section('content_header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <b> Unit</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('unit.index')}}">Units</a></li>
                    <li class="breadcrumb-item active">Create Unit</li>
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
                        <h3 class="card-title">Create Unit</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('unit.store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row justify-content-center">
                            <div class="col-8 row">
                                <div class="form-group col-12">
                                    <label for="#">Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Unit name eg. Pieces" name="name"
                                        value="{{old('name')}}">
                                </div>

                                <div class="form-group col-12">
                                    <label for="#">Code</label>
                                    <input type="text" class="form-control" id="" placeholder="Code eg. pc" name="code"
                                        value="{{old('code')}}">
                                </div>

                                <div class="form-group ">
                                    @include('partials.status',['checked'=>true,'name'=>'default',
                                    'on'=>'true','off'=>'false'])
    
                                </div>
                            </div>
                            

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>
</section>



@endsection