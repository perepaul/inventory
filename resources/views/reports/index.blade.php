@extends('home')

@section('content_header')
    
@endsection

@section('content')

<section class="content">
    <div  class="container-fluid ">
      <div  class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"><b> Sales Report</b></h3>
            </div>

            <form role="form">
                <div class="card-body">

                    <div style="margin-left: 200px" class="row">
                        <div class="form-group col-md-6">
                            {{-- <label class="col-sm-2 control label" for="#">From Date</label>
                            <input type="date" id="exampleInputEmail1"> --}}
                            <label for="">From Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-table"></i></span>
                                </div>
                                <input type="date" class="form-control-md">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            {{-- <label class="col-sm-2" for="#">To Date</label>
                            <div>
                                <i class="fa fas-calender-plus"></i>
                            <input type="date" id="exampleInputEmail1">
                            </div> --}}
                            <label for="">To Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-table"></i></span>
                                </div>
                                <input type="date" class="form-control-md">
                            </div>
                        </div>

                    </div>
                    {{-- <div style="margin-left: 210px" class="row">
                        <div class="form-group">
                        <label class="" for="">Sales Name:</label>
                        <select class="input-group form-control" name="" id="">
                            <option value="-All-">-All-</option>
                        </select>
                    </div>
                    </div> --}}
                        <div class="text-center">
                            <div class="form-group">
                                <button class="btn btn-success btn-flat">Show</button>
                                <button class="btn btn-warning btn-flat">Close</button>
                            </div>
                        </div>
                </div>   
            </form>


          </div>
        </div>

        <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title"> <b> Total Sales Report</b></h3>
              </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Invoice</th>
                <th>Sales Date</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Total Invoice</th>
                <th>Total Sale For The Day</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>Here</td>
                <td>
                  Here
                </td>
                <td>Here</td>
                <td> Here</td>
                <td>Here</td>
                <td>
                 Here
                </td>
              </tr>
             
              </tbody>
    
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        </div>
    </div>
        </div>
      </div>
    </div>
</section>
@endsection