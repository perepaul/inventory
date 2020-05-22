@extends('adminlte::page')
@section('title', 'Edit Employee Data')
@section('content_header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <b> Edit Employee Data</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('user.index')}}">Users</a></li>
                    <li class="breadcrumb-item active">Edit Employee Data </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection


@section('content')
<section class="content">
    <div class="container-fluid ">
        <form action="{{route('user.update', $employee->id)}}" method="POST" role="form" class="row"
            enctype="multipart/form-data">
            <!-- general form elements -->
            @csrf
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Edit Employee Data</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- form start -->
                        <div class="form-group">
                            <label for="#">Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')??$employee->name}}"
                                id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="#">Email Address</label>
                            <input type="text" class="form-control" value="{{old('username')??$employee->username}}"
                                id="exampleInputEmail1" placeholder="Email Address" name="username">
                        </div>

                        <div class="form-group">
                            <label for="#">Password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="#">Re-enter Password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1"
                                placeholder="Re-enter Password">
                        </div>
                        <div class="form-group">
                            <label for="#">User Profile</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        @include('partials.roles-permission',['roles'=>$roles,'permissions'=>$permissions,'user_role'=>$employee->roles()->first()['id']])
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">Update</button>
                </div>

            </div>
            <!-- /.card -->
        </form>
    </div>
</section>


@endsection


@section('load_js')
<script>
    $(function(){
        handleRoleSelect({{(int) $employee->roles()->first()['id']}})
    })
    $('#role-select').change(()=>handleRoleSelect())
</script>
@endsection
