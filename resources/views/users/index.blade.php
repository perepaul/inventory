@extends('home')

@section('content_header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Employees</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Employee</li>
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

                    <a href="{{route('user.create')}}" class="btn btn-primary">Add Employee</a>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-stripped table-hover text-md">
                        <thead>
                            <tr>
                                <th>User Image</th>
                                <th>Employee Name</th>
                                <th>Employee Role</th>
                                {{-- <th></th>
                    <th>Remaining Stock</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                            <tr>
                                {{-- @dd(asset(config('constants.profile_image_dir').'/'.$employee->passport)) --}}
                                <td>
                                    <img src="{{asset(config('constants.profile_image_dir').'/'.$employee->passport)}}"
                                        alt="" width="30" height="30" class="img-responsive img-circle">
                                </td>
                                <td>
                                    {{$employee->name}}
                                </td>
                                <td>{{$employee->roles()->first()['display_name']}}</td>
                                <td>
                                    <a href="{{route('user.edit',$employee->id)}}" class="btn btn-warning btn-sm">Edit
                                        <i class="fa fa-edit"></i> </a>
                                    <a href="{{route('user.destroy',$employee->id)}}"
                                        class="btn btn-danger btn-sm">Delete <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <h6>@lang('No user yet')</h6>
                                </td>
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

@endsection
