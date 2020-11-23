{{-- @dd($sale) --}}
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">

                                <div class="center">
                                    <img src="https://www.sparksuite.com/images/logo.png">
                                </div>

                            </td>

                            {{-- <td>
                                Receipt #: {{$sale->reference_no}}<br>
                            Date: {{$sale->formatDate()}}<br>
                </td> --}}
            </tr>
        </table>
        </td>
        </tr>

        <tr class="information">
            <td colspan="3">
                <table>
                    <tr>
                        <td>
                            {{$store_config['bussiness_name']??'dummy bussiness name'}}.<br>
                            {{$store_config['address']??'dummy bussiness address'}}<br>
                            {{$store_config['city']??'dummy city'}}, {{$store_config['state']??'dummy state/province'}}
                        </td>
                        <td></td>
                        <td>
                            Receipt #: {{$sale->reference_no??'dummy ref no'}}<br>
                            Sold By : {{\Str::limit($sale->user->name??'dummy employee',50,'')}}<br>
                            Date: {{$sale->formatDate()??'1 Jan, 2020'}}
                        </td>
                    </tr>

                    <tr class="push-down">
                        <td colspan="3">
                            <center>
                                Payment Method&nbsp;:&nbsp;{{ucfirst($payment_method->name)??'transfer'}}
                            </center>
                        </td>
                    </tr>
                </table>
            </td>
            {{-- <td></td> --}}
        </tr>

        <tr class="heading">
            <td>
                Item
            </td>

            <td>
                Quantity
            </td>
            <td>
                Price
            </td>
        </tr>

        @foreach($sale->sale_items as $saleItem)
        <tr class="item">
            <td>
                {{$saleItem->product->name}}
            </td>
            <td>{{$saleItem->quantity}}</td>
            <td>
                {{format_currency($saleItem->product->price($sale->type,$saleItem->unit)*$saleItem->quantity,true)}}
            </td>
        </tr>
        @endforeach
        <tr class="total">
            <td></td>
            <td></td>
            <td width="200px">
                <table style="text-align:right;">
                    <tr>
                        <td>Discount:</td>
                        <td>{{format_currency($sale->discount,true)}}</td>
                    </tr>
                    <tr>
                        <td>Subtotal:</td>
                        <td>{{format_currency($sale->total+$sale->discount,true)}}</td>
                    </tr>
                    <tr>
                        <td>Net Total:</td>
                        <td>{{format_currency($sale->total,true)}}</td>
                    </tr>
                </table>
                {{-- Discount: {{format_currency($sale->discount)}}<br>
                Subtotal: {{format_currency($sale->total)}}<br> --}}
            </td>
        </tr>
        </table>
    </div>
    <style>
        @page {
            size: auto;
            margin: 0mm;
        }

        @media print {

            *,
            table,
            .invoice-box {
                font-size: 8px !important;
                box-shadow: none !important;
                border: none;
                padding: none;
            }

            .invoice-box {
                max-width: 1200px;
                box-shadow: none !important;
                border: none !important;
                padding: none !important;
                line-height: 14px;
            }
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(3) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box .center {
            /* height:5000px; */
            /* margin: auto; */
            /* max-width: 500px; */
            /* width: 300px; */
            width: 100%;

        }

        .invoice-box .center img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 20%;
        }

        .invoice-box table tr.information table tr.push-down td {
            padding-bottom: 8px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item:nth-last-child(2) td {
            border-bottom: none;
            padding-bottom: 20px;
        }



        .invoice-box table tr.total td:nth-child(3) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        $(function(){
            print();
        })

    function print(){
        $('body').printThis({
            debug:false,
            afterPrint: function(){
                redirect()
            }
        });
    }
    function redirect()
    {
        Swal.fire({
        title: 'Printed?',
        text: "Was the print succefful?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText:'No'
        }).then((result) => {
            if (result.value) {
                window.localStorage.setItem('checkedout',true)
            window.location.href ='{{route("sales.index")}}'
            }else{
                print()
            }
        });
    }
    </script>
</body>

</html>
