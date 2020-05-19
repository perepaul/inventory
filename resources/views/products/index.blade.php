@extends('home')

@section('content_header')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                
                <button class="btn btn-primary">Add Product</button>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Brand</th>
                    <th>Total Stock</th>
                    <th>Remaining Stock</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Image Here</td>
                    <td>
                      Name Here
                    </td>
                    <td>Brand Here</td>
                    <td> Total Here</td>
                    <td>Remaining Here</td>
                    <td>
                      <button class="btn btn-warning">Edit <i class="fa fa-edit"></i> </button>
                      <button class="btn btn-danger">Delete <i class="fa fa-trash"></i> </button>
                    </td>
                  </tr>
                 
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