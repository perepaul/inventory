@extends('home')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><b>Settings</b></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Settings</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection


@section('content')

<section class="content">
    <div class="container-fluid">
      <!-- SELECT2 EXAMPLE -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">App Settings</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- /.card-header -->
        <form role="form" >
        <div class="card-body">
          <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Prefix</label>
                      <input type="text" class="form-control" placeholder="Mr/Mrs/Miss">
                  </div>
              </div>
             <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Owner First Name</label>
                      <input type="text" class="form-control" placeholder="First Name">
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Owner Last Name</label>
                      <input type="text" class="form-control" placeholder="Last Name">
                  </div>
              </div>

            <div class="col-md-6">
            <div class="form-group">
                <label for="#">Business Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name">
            </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
                <label for="#">Currency</label>
                <select class="form-control" name="" id="">
                    <option value="currency">Choose Currency</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="#">Address</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Company Address">
            </div>
        </div>
        <div style="margin-top: 32px;" class="col-md-6">
            <div class="form-group">
                <input type="file" class="custom-file-input" id="exampleInputFile">
                <label  class="custom-file-label" for="exampleInputFile">Upload Logo</label>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="">Business Phone No</label>
                <input type="number" class="form-control" placeholder="Business No:">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Alternate Phone No</label>
                <input type="number" class="form-control" placeholder="Alertnate No:">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Country</label>
                <input type="number" class="form-control" placeholder="Country:">
            </div>
        </div>
     <div class="col-md-6">
            <div class="form-group">
                <label for="">State</label>
                <input type="number" class="form-control" placeholder="State:">
            </div>
        </div>
     <div class="col-md-6">
            <div class="form-group">
                <label for="">City</label>
                <input type="number" class="form-control" placeholder="City:">
            </div>
        </div>
     <div class="col-md-6">
            <div class="form-group">
                <label for="">Zip Code</label>
                <input type="number" class="form-control" placeholder="ZipCode:">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-lg">Submit</button>
          </div>

      </div>
    </div>
</form>
</section>

    
@endsection