@extends('home')


@section('content_header')

    
@endsection


@section('content')

<section class="content">
    <div  class="container-fluid ">
      <div class="row">

        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Update Employee Data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="#">Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name">
                </div>
                <div class="form-group">
                  <label for="#">Email Address</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email Address">
                </div>
               
                <div class="form-group">
                  <label for="#">Password</label>
                  <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Password">
                </div>
                <div class="form-group">
                <label for="#">Re-enter Password</label>
                  <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Re-enter Password">
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
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

        </div>

        <div class="col-md-6">
            <form role="form">

                <div class="form-group">
                    <label for="#">Select Employee Role</label>
                    <select class="form-control select2bs4" style="width: 100%;">
                        <option value="Selected">Choose Role</option>
                        <option >Admin</option>
                        <option >Cashier</option>
                    </select>
                  </div>

                  <div class="text-center">
                  <div class="form-group">
                      <label for="#">Can Create User</label>
                      <input type="checkbox">
                  </div>
                  <div class="form-group">
                      <label for="#">Can View Product</label>
                      <input class="" type="checkbox">
                  </div>
                  <div class="form-group">
                      <label for="#">Can Create Product</label>
                      <input type="checkbox">
                  </div>
                  <div class="form-group">
                      <label for="#">Can Edit Product</label>
                      <input type="checkbox">
                  </div>
                  <div class="form-group">
                      <label for="#">Can Update Stock</label>
                      <input type="checkbox">
                  </div>
                  <div class="form-group">
                      <label for="#">Can Sell Product</label>
                      <input type="checkbox">
                  </div>

                </div>

            </form>

        </div>

      </div>
    </div>
</section>
    
@endsection