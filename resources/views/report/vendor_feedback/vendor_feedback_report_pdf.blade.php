<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Vendor Feedback</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
        }
    </style>
</head>

<body>
<table style="width: 100%">

    <h1 style="text-align: center">{{$information->company_name}}</h1>
    <p style="text-align: center">{{$information->company_phone}}</p>
    <p style="text-align: center">{{$information->company_email}}</p>

    <thead>
    <tr>
        <th>Order Id</th>
        <th>Vendor Name</th>
        <th>Vendor Phone</th>
        <th>Address</th>
        <th>Feedback</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_feedback as $key=>$all_feedbacks)
        <tr>
            <td>{{$all_feedbacks->selsOrderId}}</td>
            <td>{{$all_feedbacks->name}}</td>
            <td>{{$all_feedbacks->phone}}</td>
            <td>{{$all_feedbacks->address}}</td>
            <td>{{$all_feedbacks->feedback}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
<script>
    window.print();
    window.close();
</script>

</html>