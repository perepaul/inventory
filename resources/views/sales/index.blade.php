@extends('adminlte::page')

@section('css')
<style>
    .table td {
        vertical-align: middle !important;
        padding: 0.4rem !important;
    }
</style>
@stop
@section('title','Sales')
@section('content_header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <b> Sales</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Sell Product</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection

@section('content')

<section class="content">
    <div class="container-fluid ">
        <div class="card card-secondary">
            <div class="card-body">
                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-8 offset-md-2 mb-5" style="">
                            <form action="" id="product_search_form">
                                <select name="product_search" id="product_search" class="w-100"
                                    style="height:100px;"></select>
                            </form>
                        </div>

                        <div class="col-md-9">

                            <table id="example2" class="table table-stiped table-md w-100 pr-5 v-align-middle"
                                style="border-bottom:1px solid #dee2e6;">
                                <thead class="bg-teal">
                                    <tr>
                                        <th width="250px">Name</th>
                                        <th width="160px">Quantity</th>
                                        <th>Price </th>
                                        <th width="120px">Discount</th>
                                        <th>Total</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm" id="table-details">
                                    {{-- <tr>
                                        <td class="p-2">Name</td>
                                        <td class="p-2">
                                            @include('partials.select')
                                        </td>
                                        <td class="p-2">₦300000</td>
                                        <td class="p-2"><input type="text" name="discount" class="form-control"></td>
                                        <td class="p-2">₦30000</td>
                                        <td class="p-2"><button
                                                class=" btn btn-danger btn-sm text-sm">&times;</i></button></td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <td colspan="5" class="text-center">Nothing Here!</td>
                                    </tr> --}}

                                </tbody>

                            </table>

                        </div>

                        <div class="col-md-3">
                            <div class="p-3 bg-teal w-100 m-0">

                                <div class="form-group text-sm">
                                    <label for="#">Discount</label>
                                    <input type="text" class="form-control onlydigits no-input" id="total_discount"
                                        placeholder="Discount Price">
                                </div>

                                <div class="form-group text-sm">
                                    <label for="#">Subtotal</label>
                                    <input type="text" class="form-control onlydigits no-input" id="sub_total"
                                        placeholder="Total ">
                                </div>
                                <div class="form-group text-sm">
                                    <label for="#">Grand Total</label>
                                    <input type="text" class="form-control onlydigits no-input" id="total"
                                        placeholder="Total ">
                                </div>
                                <div class="form-group text-sm">
                                    <label for="#">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control">
                                        @foreach ($payment_methods as $method)
                                        <option value="{{$method->id}}" @if($method->id == 1)selected
                                            @endif>{{$method->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 justify-content-between d-flex">
                                    <button onclick="deleteSale()" class="btn btn-warning">Cancel</button>
                                    <button onclick="validateCheckout()" class="btn btn-success">Checkout </button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
@section('load_js')
<script>
    $(function () {
        boot();

        $(document).on('keydown', '.onlydigits', function (e) {
            return onlyNumbers(e);
        });

        $('#product_search').select2({
            placeholder: "Search products by Sku, Name or Scan Barcode",
            allowClear: true,
            "language": {
            "noResults": function(){
            return "No products foound";
            }
            },
            ajax: {
            url: '{{route("sales.search")}}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                q: params.term // search term
                };
            },
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            processResults: function (response) {
                return {
                results: response
                };
            },
            cache:true,
            }
        });

        $(document).on('change','#product_search', function(e){
            var id = e.target.value;
            if(id==null||id=='undefined'||id==""){
                return false;
            }
            $.ajax({
                url:'/sales/add',
                method: 'get',
                data:{id}
            }).then(
                res =>{
                    playsound('beep')
                    mountItems(res);
                },

                err => {
                    var payload = err.responseJSON;
                    if(payload.message){
                        notify(payload.message,payload.type)
                        playsound(payload.types)
                        }else{
                            playsound('error')
                            notify('Product could not be added','error')
                        }
                        clearSelect()
                })
        })

    });

    function boot(){
        if(window.localStorage.getItem('checkedout')){
            notify('Sale completed successfully','success');
            window.localStorage.removeItem('checkedout');
        }
        $.ajax('sales/boot')
        .then(res => {
                if(res.data){
                    mountItems(res);
                }
        });
    }

    function update(id,elem)
    {
        if(elem.value == 0 || isNaN(elem.value))
        {
            return ;
        }
        valid = validateUpdate(elem)
       if(valid){
           $.ajax('sales/'+id+'/update/'+elem.value)
           .then(res => {
               playsound('beep')
               mountItems(res)
           },
           err => {
               payload = err.responseJSON;
               if(payload.message)
               {
                notify(payload.message,payload.type)
               }else{
                   notify('Oops! an error occured!','error')
               }
               clearSelect()
           })
       }else{

       }
    }
    function delete_sale_item(id)
    {
        $.ajax('sales/'+id+'/delete')
        .then(res=>{
            if(res.success)
            {
                playsound('beep')
               mountItems(res);
            }
        },
        err=>{
            payload = err.responseJSON;
            if(payload.message){
                playsound(payload.type)
                notify(payload.message,payload.type);
            }else{
                playsound('error')
                notify('Oops!! an error occured','error')
            }
            clearSelect()
        })
    }

    function deleteSale()
    {
        con = confirm('are you sure you want to cancel sale');
        if(con) {

            $.ajax('sales/delete-all')
            .then(res=>{
                if(res.data)
                {
                    playsound('beep');
                    mountItems(res)
                }
            },
            err => {
                payload = err.responseJSON;
                if(payload.message)
                {
                    notify(payload.message,payload.type)
                }
                clearSelect()
            })
        }
    }

    function validateCheckout()
    {
        sub_total = $('#sub_total').val()
        total_discount = $('#total_discount').val()
        payment_method = $('#payment_method').val()
        total = $('#total').val()
        r_sub_total = parseInt(sub_total.replace(',',''))
        r_total_discount = parseInt(total_discount.replace(',',''))
        total = parseInt(total.replace(',',''))

        if(typeof(payment_method) == 'null' || payment_method == "" || typeof(payment_method) == 'undefined'|| isNaN(payment_method) )
        {
            notify('select payment method','warning')
            return false;
        }


        if(r_total_discount > r_sub_total)
        {
            text = "Total Discount is grater than the Grand total"
            Swal.fire({
                title: 'Are you sure?',
                text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continue anyways!'
            }).
                then((result) => {
                    if (result.value) {
                        checkout(total,r_total_discount,payment_method);
                    }
            })

        }else{
            checkout(total,r_total_discount,payment_method);
        }

    }

    function checkout(total, total_discount, payment_method_id)
    {
        _token = '{{csrf_token()}}'
        $.ajax({
            method:'post',
            url:'sales/checkout',
            data:{
                _token,
                total,
                total_discount,
                payment_method_id
            }
        }).then(
            res=>{
                // notify('Sale completed Successfully','success')
                mountItems(res,true)
            },
            err=>{
                payload = err.responseJSON
                if(payload.message)
                {
                    notify(payload.message,payload.type)
                }else{
                    notify('Oops! checkout failed','error');
                }
            });
    }



    function mountItems(data,checkout=false)
    {
        if(checkout){
            handlePrint(data.data.receipt_ref);
        }
        html = data.data.html;
        total = data.data.total
        total_discount = data.data.total_discount
        sub_total = data.data.sub_total
        $('#sub_total').val(sub_total);
        $('#total').val(total);
        $('#total_discount').val(total_discount);
        $('#table-details').html(html)
        clearSelect()
    }

    function handlePrint(ref)
    {
        window.location.href = "sales/"+ref+"/print"
    }

    function clearSelect()
    {
        $('#product_search').val(null).trigger('change')
    }
</script>
@stop
