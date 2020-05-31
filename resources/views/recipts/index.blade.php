@extends('adminlte::page')

@section('content_header')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><strong>Print Recipt</strong></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Invoice</li>
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
            <div class="col-12">
              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <img class="img-circle" width="100" src="data:image/png;base64,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" alt=""> My Shop.
                      <small class="float-right">Date: 31/05/2020</small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-6 invoice-col">
                    
                    <address>
                      <strong>Purchased From Myshop</strong><br>
                      Order #: <span>898990</span><br>
                      Shop Address: <span>Plot A Family Support</span><br>
                      Phone: (804) 123-5432<br>
                      Sold By : <span>Emma</span>
                    </address>
                  </div>
                  <!-- /.col -->

                  <div class="col-6">
                    <p class="lead">Purchased Date 2/22/2014</p>
  
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>&#8358;250.30</td>
                        </tr>
                        <tr>
                          <th>Tax (9.3%)</th>
                          <td>&#8358;10.34</td>
                        </tr>
                        <tr>
                          <th>Discount:</th>
                          <td>&#8358;5.80</td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>&#8358;265.24</td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <!-- /.col -->
                </div>
                <!-- /.row -->
  
                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Serial #</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td>1</td>
                        <td>One Cup of Accountant</td>
                        <td>455-981-221</td>
                        <td>Aptech Aptech Aptech Aptech</td>
                        <td>&#8358;64.50</td>
                      </tr>
                
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                
                <!-- /.row -->
                <div class="row no-print">
                  <div class="col-12">
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                      <i class="fas fa-download"></i> Print
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div>
    </div>
</section>




    
@endsection