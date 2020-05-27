@extends('home')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mt-5">
                <center>
                    <img class="img-circle"
                        src="{{asset(config('constants.profile_image_dir') .'/'.auth()->user()->passport)}}" alt=""
                        width="220" height="220" style="vertical-align: middle !important">
                </center>

            </div>
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Profile Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('user.updateProfile',auth()->user()->id)}}" role="form" autocomplete="off"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" value="{{auth()->user()->name}}" autocomplete="off"
                                    class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                                {{-- </div><div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" autocomplete="off" class="form-control"
                                        id="exampleInputPassword1" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword2">Confirm password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="exampleInputPassword2" placeholder="Confirm password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Profile picture</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="passport" class="custom-file-input"
                                                id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                            </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>
</section>

@endsection
