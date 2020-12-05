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

                        <div class="col-md-8 offset-md-2 mb-5">
                            {{-- <form action="" id="product_search_form">
                                <select name="product_search" id="product_search" class="w-100"
                                    style="height:100px;"></select>
                            </form> --}}
                            <input type="text" id="search" class="form-control"
                                placeholder="Search products by Sku, Name or Scan Barcode">
                        </div>

                        <div class="col-md-9">

                            <table id="example2" class="table table-stiped table-md w-100 pr-5 v-align-middle"
                                style="border-bottom:1px solid #dee2e6;">
                                <thead class="bg-teal">
                                    <tr>
                                        <th width="250px">Name</th>
                                        <th width="10px;">Quantity</th>
                                        <th>Price </th>
                                        <th>Unit</th>
                                        <th>Total</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm" id="table-details">

                                </tbody>

                            </table>

                        </div>

                        <div class="col-md-3">
                            <div class="p-3 bg-teal w-100 m-0">
                            <div class="form-group text-sm">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-control" onchange="changeSaleType()">
                                        <option value="retail" selected>Retail</option>
                                        <option value="wholesale">Wholesale</option>
                                    </select>
                                </div>
                                <div class="form-group text-sm">
                                    <label for="#">Subtotal</label>
                                    <input type="text" class="form-control onlydigits no-input" id="sub_total"
                                        placeholder="Subtotal ">
                                </div>
                                <div class="form-group text-sm">
                                    <label for="#">Discount</label>
                                    <input type="text" class="form-control onlydigits" id="discount" onchange="calculateDiscount()"
                                        placeholder="Discount" value="0" name="discount">
                                </div>
                                <div class="form-group text-sm">
                                    <label for="#">Grand Total</label>
                                    <input type="text" class="form-control onlydigits no-input" id="total"
                                        placeholder="Subtotal ">
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


        onScan.attachTo(document, {
            suffixKeyCodes: [13], // enter-key expected at the end of a scan
            reactToPaste: true, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)
            minLength:4,
            onScan: function (sCode, iQty) { // Alternative to document.addEventListener('scan')
                getProductWithSku(sCode);
            },
            onPaste : function(sPasted, oEvent){
               var elem = oEvent.target
               $(elem).val(sPasted)
            }
        });


        // setTimeout(()=>{

        //     onScan.simulate(document, '378273822839390303');
        // },3000)



        boot();

        $('#search').autocomplete({
            serviceUrl: '{{route("sales.search")}}',
            type:'GET',
            dataType: 'json',
            paramName: 'q',
            minChars:2,
            onSearchStart: function(params){},
            showNoSuggestionNotice: true,
            // triggerSelectOnValidInput:true,
            preventBadQueries:true,

            onSelect: function (suggestion) {
                // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
                getProduct(suggestion.data)
            }
        });

        $(document).on('keydown', '.onlydigits', function (e) {
            return onlyNumbers(e);
        });


    });

     function getProduct(id){
        // var id = e.target.value;
        // console.log('value received ' + id)
        if(id==null||id=='undefined'||id==""){
        return false;
        }else{
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
        }
    }

    function getProductWithSku(sku)
    {
        if(sku == null || sku=="undefined" || sku==""){
            return false;
        }else{
            $.ajax({
                url:'/sales/add-sku',
                method: 'get',
                data:{sku}
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
        }

    }

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
            $(elem).val($(elem).data('oldValue'));
            notify('Quantity cannot be lower than 1', 'warning')
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

    function calculateDiscount()
    {
        discount = $('[name=discount]').val();
        if(discount == ''){
            discount = 0;
        }
        $.ajax('sales/discount/'+discount)
        .then(
            res => {
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
           }
        )
    }
    function changeSaleType()
    {
        var type = $('[name=type]').val()
        console.log(type);
        $.ajax('sales/update-type/'+type)
        .then(
            res => {
                playsound('beep');
                mountItems(res);
            },
            err => {
                payload = err.responseJSON;
               if(payload.message)
               {
                notify(payload.message,payload.type)
               }else{
                   notify('Oops! an error occured!','error')
               }
            }
        )
    }

    function changeUnit(id,element)
    {
        // console.log(element);
        var unit = $(element).val()
        $.ajax('sales/'+id+'/change-unit/'+unit)
        .then(
            res => {
                playsound('beep');
                mountItems(res);
            },
            err => {
                payload = err.responseJSON;
               if(payload.message)
               {
                notify(payload.message,payload.type)
               }else{
                   notify('Oops! an error occured!','error')
               }
            }
        )
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
        Swal.fire({
            'title':'Are you Sure',
            'icon':'question',
            'text':'This action will delete this sale!',
            showCancelButton:true,
            cancelButtonText:'Nope!',
            confirmButtonText:'Yes Cancel Sale!',
            confirmButtonColor:'#850d0d',
            cancelButtonColor:'#307307'
        }).then((result)=> {
            if(result.value){
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
        })
    }

    function validateCheckout()
    {
        sub_total = $('#sub_total').val()
        discount = $('#discount').val()
        payment_method = $('#payment_method').val()
        total = $('#total').val()
        sub_total = parseInt(sub_total.replace(',',''))
        discount = parseInt(discount.replace(',',''))
        total = parseInt(total.replace(',',''))

        if(typeof(payment_method) == 'null' || payment_method == "" || typeof(payment_method) == 'undefined'|| isNaN(payment_method) )
        {
            notify('select payment method','warning')
            return false;
        }

        if(discount > total)
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
                        checkout(total,discount,payment_method);
                    }
            })

        }else{
            checkout(total,discount,payment_method);
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
        type = data.data.type;
        total = data.data.total
        discount = data.data.discount
        sub_total = data.data.sub_total
        $(`select[name=type] option[value=${type}]`).attr('selected','selected');
        $('#sub_total').val(sub_total);
        $('#total').val(total);
        $('#discount').val(discount);
        $('#table-details').html(html)
        clearSelect()
    }

    function handlePrint(ref)
    {
        window.location.href = "sales/"+ref+"/print"
    }

    function clearSelect()
    {
        $('#search').val('')
    }
</script>
@stop
