


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .section1{
            border-bottom:2px solid #ccc;
        }
        .section2{
            border-bottom:2px solid #ccc;
        }
        p{
            margin-bottom: .3rem;
        }
        .three-col p{
            float: left;
        }
        p b{
            font-weight: 500;
        }
        .section5{
            border-top: 2px solid #ccc;
        }
        footer{
            
            
            opacity: 0;
            
        }
        .section6{
                /* position: relative; */
                border-top: 2px solid #ccc;
            }
        @media print{
            .section6{
                /* position: relative; */
                border-top: 2px solid #ccc;
            }
            footer{
                position: fixed;
                bottom: 0;
                left:0;
                width: 100%;
                opacity: 1;
                /* height:50px; */
            
                padding-top: 30px;
            }
        }


    </style>

</head>
<body>
  

    {{-- @php
        var_dump($odetails);
    @endphp --}}

<section>
    <div class="container">
        <div class="row section1"  style="padding-top: 40px;">
            <div class="col-md-4">
                <div class="logo_part">
                    <img src=" {{ asset('assets/images/logo.png') }}" alt="">
                   
                </div>
            </div>
             <div class="col-md-3">
                <div class="packing_list d-flex row mt-2">
                        <p><b>Delivery Note </b></p>
                </div>

            </div>
            <div class="col-md-5">
                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($odetails->selsOrderId, 'C93')}}" alt="barcode" class="img-fluid"  />
            <p class="" style="margin-left:20%;">#{{$odetails->selsOrderId}}</p>
                <div class="packing_list d-flex row mt-2">
                    <div class="col-md-6">
                        {{-- <p><b>Delivery Note </b></p> --}}
                    </div>
                    <div class="col-md-6 d-inline">
                        <span class="mr-3"> Order ID :</span>
                    <span class="text-right ml-3">{{$odetails->selsOrderId}}</span>
                    </div>
                    
                    
                </div>

            </div>
        </div>
        <div class="row section2 pb-3">
            <div class="col-md-7">
                <div class="left-col-item">
                    <p style="font-weight: 700;">Ship Address: </p>
                <span>{{$odetails->branchName}}</span> 
                <br>
                <br>
                    <p style="font-weight: 700;">Delivery Address:</p>
                {{-- <span>{{ $odetails->receiverAddress}}</span> <br> --}}
                <span>{{ $odetails->zoneName}}</span><br>
                <span>{{ $odetails->areaName}}</span>
                    {{-- <p>Ship Via:</p>
                    <span>AJR</span>
                    <p>Shipping Marks:</p> --}}

                </div>
            </div>

            <div class="col-md-5">
                <div class="right-col-item">
                    {{-- <p>Consignment Item: </p>
                    <span>6785</span> --}}
                    <p>Date Printed: (DD.MM.YYYY)</p>
                    <span> {{ date('d-m-y') }}</span>
                    <br>
                    <br>
                    <p style="font-weight: 700;">Payment Address:</p>
                    {{-- <p>Payment Method:</p> --}}
                    <span>{{$odetails->receiverName}}</span> <br>
                    <span>{{$odetails->receiverPhone}}</span> <br>
                    <span>{{$odetails->receiverAddress}}</span>
                    {{-- <span>Shipping Marks</span> --}}

                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-3">
                <div class="three-col-1">
                    {{-- <p>Order Id: <b class="text-right ml-4">{{$odetails->selsOrderId}}</b></p> --}}
                    <p>Product Name: <b class="text-right ml-4"> {{strtoupper($odetails->productTitle)}}</b></p>
                {{-- <p> {{strtoupper($odetails->productTitle)}}</p> --}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="three-col w-100">
                    <p class="w-60 mr-4">Dimension(m) : </p>
                    <p class="w-40 text-right">{{$odetails->dimensionSize}}</p>
                    <p class="w-60 mr-3">Gross Weight (kg):</p>
                <p class="w-40 text-right">{{$odetails->dimensionWeight}}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="four-col text-center">
                <p>Amount to be collected: <span class="ml-4">{{$odetails->productPrice}}</span></p>
                </div>

                
            </div>
            
        </div>
        {{-- <div class="row mt-2">
                
                <div class="col-12">
                    <p><b>Shipment Summery:</b> </p>
                </div>
                <div class="col-3 text-left">
                    
                    <p>Pallet Type</p>
                    <p class="text-uppercase">CHEML GR</p>
                </div>
                <div class="col-3 text-left">
                    <p>Palet Id:</p>
                    <p>36567</p>
                </div>
                <div class="col-3 text-left">
                    <p>Weight Gross</p>
                    <p>567kg</p>
                </div>
                <div class="col-3 text-left">
                    <p>Net Weight</p>
                    <p>556kg</p>
                </div>
        </div>

        <div class="row section5">
                <div class="col-6 text-left">
                    <p><b class="mr-4">1</b> pakage in Total Gross</p>
                    
                </div>
                
                <div class="col-3 text-left">
                    
                    <p>567kg</p>
                </div>
                <div class="col-3 text-left">
                    
                    <p>556kg</p>
                </div>
        </div> --}}
    </div>
</section>

<footer>
    <div class="container">
        <div class="row section6">
            <div class="col-md-3">
                <p>Report</p>
            </div>
            <div class="col-md-3">
                <p>Shipment Packing List</p>
            </div>
            <div class="col-md-3 text-right">
                <p>IFS Application</p>
            </div>
            <div class="col-md-3 text-right">
                <p>Page : <span class="ml-3">1(1)</span> </p>
            </div>
        </div>
    </div>
</footer>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>