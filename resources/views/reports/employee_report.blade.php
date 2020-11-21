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
              <h3 class="card-title"><b> Employees Report</b></h3>
            </div>

            <form role="form">
                <div class="card-body">

                    <div style="" class="row">
                        <div class="form-group col-md-6">
                            {{-- <label class="col-sm-2 control label" for="#">From Date</label>
                            <input type="date" id="exampleInputEmail1"> --}}
                            <label for="">From Date</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="far fa-calendar-alt"></i>
                                </span>
                              </div>
                              <input type="date" class="form-control" id="reservation">
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
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                              </div>
                              <input type="date" class="form-control float-right" id="reservationtime">
                            </div>
                        </div>

                    </div>
                    <div style="" class="row">
                        <div class="form-group">
                        <label class="" for="">Employee Name:</label>
                        <select class="input-group form-control" name="" id="">
                            <option value="-All-">-All-</option>
                        </select>
                    </div>
                    </div>
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
                <h3 class="card-title"> <b> Employee Report</b></h3>
              </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Invoice</th>
                <th>Sales Date</th>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Total Invoice</th>
                <th>Total Sale</th>
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