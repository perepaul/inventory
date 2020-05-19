@extends('home')

@section('content_header')
    
@endsection


@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-4">

            <img class="img-fluid" src="https://via.placeholder.com/500" alt="">

          </div>
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Product Details</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Name">
                </div>  
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Brand</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Brand Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Product Quantity</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Total Quantity">
                </div>
                 <div class="form-group">
                    <label for="exampleInputPassword1">Product Alert</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Remaining Products">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload Image</label>
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
                <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
            <!-- /.card -->

  </div>
      </div>
    </div>
</section>
    
@endsection