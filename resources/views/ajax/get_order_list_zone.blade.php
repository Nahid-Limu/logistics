<table id="example" class="table table-hover table-bordered">
    <thead>
    <tr>
        {{--<th>Order</th>--}}
        <th>Order Id</th>
        <th>Vendor</th>
        <th>Product</th>
        <th>Dimension</th>
        <th>Quantity</th>
        <th>Charge</th>
        <th>Delivery Zone</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $key=>$order)
        <?php
        $k=0;
        foreach($order_selected as $os){
            if($order->id==$os->order_id){

                $k=1;
            }

        }
        ?>
        <tr>
            {{--<td>{{$key++}}</td>--}}
            <td>{{$order->selsOrderId}}</td>
            <td>{{$order->vendor_name}}</td>
            <td>{{$order->productTitle}}</td>
            <td>{{$order->size}}</td>
            <td>{{$order->productQuantity}}</td>
            <td>{{$order->deliveryCharge}}</td>
            <td>{{$order->zone_name}}</td>
            <td>
                <input type="checkbox" @if($k==1) checked @endif autocomplete="off" value="{{$order->id}}" class="form-check-input check_order">
            </td>

        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('.check_order').click(function () {
            if ($(this).is(':checked')){
                let order_id=this.value;
                let employee_id=$('#emp_id').val();
                let url="{{route('save_temp_order_employee')}}";
                url+="/?order_id="+order_id+"&employee_id="+employee_id;
                $.ajax({
                    url:url,
                    method: "get",
                    success:function (response) {
                        console.log(response);
                    }
                })

                // alert(this.value);

            }
            else if($(this).prop("checked") == false){
                let order_id=this.value;
                let url="{{route('save_temp_order_employee')}}";
                url+="/?order_id="+order_id+"&delete="+1;
                // alert(url);
                $.ajax({
                    url:url,
                    method: "get",
                    success:function (response) {
                        console.log(response);
                    }
                })

            }

        });

        $('#example').DataTable();



    });

</script>