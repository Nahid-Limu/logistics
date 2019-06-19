<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <button type="button" onclick="printDiv('advance_report')"><i class="fa fa-print"></i>Print</button>
    <div id="advance_report">
    <h4 class="text-center">Rejected Order List</h4>
    <p class="text-center">{{$information->company_name}}</p>
    <p class="text-center">{{$information->company_email}}</p>
    <p class="text-center">{{$information->company_phone}}</p>
    <p class="text-center">{{$information->company_address}}</p>
    <table id="example" class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>Order Id</th>
            <th>Driver</th>
            <th>Vendor</th>
            <th>Reason</th>
            <th>Rejected Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{$item->selsOrderId}}</td>
                <td>{{$item->driver_name}}</td>
                <td>{{$item->vendor_name}}</td>
                <td>{{$item->reason_of_rejected}}</td>
                <td>{{date('F-d-Y',strtotime($item->rejected_date))}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
</body>
</html>