@extends('home')
@section('title','Units')
@section('content_header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Inventories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Units</li>
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

                    <a href="{{route('unit.create')}}" class="btn btn-primary">Add Unit</a>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-stripped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Default</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($units as $unit)
                            <tr>
                                <td>{{$unit->name}}</td>
                                <td>{{$unit->code}}</td>
                                <td>
                                    {{$unit->default == 1?'Yes':'No'}}
                                </td>
                                <td>
                                    <a href="{{route('unit.edit',$unit->id)}}"
                                        class="btn btn-warning btn-sm">Edit <i class="fa fa-edit"></i> </a>
                                    <a href="{{route('unit.destroy',$unit->id)}}"
                                        class="btn btn-danger btn-sm">Delete <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="6">No units yet</td>
                            </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer mx-auto bg-white">
                    {{-- {{$products->links()}} --}}
                </div>
            </div>
            <!-- /.card -->


        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

@endsection
