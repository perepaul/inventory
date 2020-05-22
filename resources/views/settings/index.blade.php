@extends('adminlte::page')
@section('title','Settings')
{{-- @dd($edit) --}}
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
    <div class="container">
        <!-- SELECT2 EXAMPLE -->
        <div class="card container">
            <div class="card-header">
                <h2 class="card-title">App Settings</h2>
            </div>
            <!-- /.card-header -->
            <form role="form" action="{{($edit)?route('settings.update'):route('settings.create')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($edit)
                @method('PUT')
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Title</label>
                                <select name="title" id="title" class="form-control">
                                    <option value="">Choose Title</option>
                                    <option value="Dr." @if(isset($s->title) && $s->title == 'Dr.') selected @endif>Dr.
                                    </option>
                                    <option value="Mr." @if(isset($s->title) && $s->title == 'Mr.') selected @endif>Mr.
                                    </option>
                                    <option value="Mrs." @if(isset($s->title) && $s->title == 'Mrs.') selected
                                        @endif>Mrs. </option>
                                    <option value="Miss." @if(isset($s->title) && $s->title == 'Miss.') selected
                                        @endif>Miss. </option>
                                    <option value="Prof." @if(isset($s->title) && $s->title == 'Prof.') selected
                                        @endif>Prof. </option>
                                    <option value="Chief" @if(isset($s->title) && $s->title == 'Chief') selected
                                        @endif>Chief </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Owner First Name</label>
                                <input type="text"
                                    value="@if(isset($s->firstname)){{$s->firstname}} @else {{old('firstname')}}@endif"
                                    name="firstname" class="form-control" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Owner Last Name</label>
                                <input type="text" name="lastname"
                                    value="@if(isset($s->lastname)){{$s->lastname}} @else {{old('lastname')}}@endif"
                                    class="form-control" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Business Name</label>
                                <input type="text" name="bussiness_name"
                                    value="@if(isset($s->bussiness_name)){{$s->bussiness_name}} @else {{old('bussiness_name')}}@endif"
                                    class="form-control" id="exampleInputEmail1" placeholder="Business name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="#">Currency</label>
                                <select class="form-control" name="currency_text" id="">
                                    <option value="">Choose Currency</option>
                                    <option value="NGN" @if(isset($s->currency_text) && $s->currency_text == 'NGN')
                                        selected @endif>NGN</option>
                                    <option value="USD" @if(isset($s->currency_text) && $s->currency_text == 'USD')
                                        selected @endif>USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="#">Currency symbol</label>
                                <select class="form-control" name="currency_sym" id="">
                                    <option value="">Currency Symbol</option>
                                    <option value="₦" @if(isset($s->currency_sym) && $s->currency_sym == '₦')
                                        selected @endif>₦</option>
                                    <option value="$" @if(isset($s->currency_sym) && $s->currency_sym == '$')
                                        selected @endif>$</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Business Phone No</label>
                                <input type="text" name="phone_1"
                                    value="@if(isset($s->phone_1)){{$s->phone_1}} @else {{old('phone_1')}}@endif"
                                    class="form-control" placeholder="Business No:">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Alternate Phone No</label>
                                <input type="text" name="phone_2"
                                    value="@if(isset($s->phone_2)){{$s->phone_2}} @else {{old('phone_2')}}@endif"
                                    class="form-control" placeholder="Alertnate No:">
                            </div>
                        </div>
                        <div style="margin-top: 32px;" class="col-md-4">
                            <div class="form-group">
                                <input type="file" name="store_logo" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Upload Logo</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="#">Address</label>
                                <textarea name="address" id="address" cols="30" rows="2" class="form-control"
                                    placeholder="Enter address">@if(isset($s->phone_2)){{$s->phone_2}} @else {{old('phone_2')}}@endif</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" name="country"
                                    value="@if(isset($s->country)){{$s->country}} @else {{old('country')}}@endif"
                                    class="form-control" placeholder="Country:">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">State / Province</label>
                                <input type="text" name="state"
                                    value="@if(isset($s->state)){{$s->state}} @else {{old('state')}}@endif"
                                    class="form-control" placeholder="State:">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">City / Town</label>
                                <input type="text" name="city"
                                    value="@if(isset($s->city)){{$s->city}} @else {{old('city')}}@endif"
                                    class="form-control" placeholder="City:">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Zip Code</label>
                                <input type="text" name="zip" placeholder="ZipCode:"
                                    value="@if(isset($s->zip)){{$s->zip}} @else {{ old('zip') }}@endif"
                                    class="form-control">
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card-footer col-md-12 bg-white ">
                    <button type="submit" class="btn btn-success btn-md float-right">@if($edit) Update @else
                        Submit @endif</button>
                </div>
            </form>
        </div>
</section>


@endsection
