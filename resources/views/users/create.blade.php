@extends('adminlte::page')
@section('title', 'Create Employee')
@section('content_header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <b> Create Employee</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Create Employee</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection


@section('content')
<section class="content">
    <div class="container-fluid ">
        <form action="{{route('user.store')}}" method="POST" role="form" class="row" enctype="multipart/form-data">
            @csrf
            <!-- general form elements -->
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Create Employee</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- form start -->
                        <div class="form-group">
                            <label for="#">Name</label>
                            <input type="text" required name="name" class="form-control" id="exampleInputEmail1"
                                placeholder="Name" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="#">Username</label>
                            <input type="text" required name="username" class="form-control" id="exampleInputEmail1"
                                placeholder="Username" value="{{old('username')}}">
                        </div>

                        <div class="form-group">
                            <label for="#">Password</label>
                            <input type="password" required name="password" class="form-control" id="exampleInputEmail1"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="#">Re-enter Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="exampleInputEmail1" placeholder="Re-enter Password">
                        </div>
                        <div class="form-group">
                            <label for="#">User Profile</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="passport" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        @include('partials.roles-permission',compact('roles','permissions'))
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">Create</button>
                </div>

            </div>
            <!-- /.card -->
        </form>
    </div>
</section>


@endsection

@section('load_js')
<script>
    $(function() {

        $('#role-select').change(()=>{
            var id = $('#role-select').val()
            var route = `/get-role-permissions/${id}`
            handleRoleSelect(route)
        })
    })
</script>

@endsection
