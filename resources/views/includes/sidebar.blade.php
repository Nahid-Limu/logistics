<?php
$url=request()->route()->getName();
?>
<nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">
    <div class="sidebar-collapse menu-scroll">
        <ul id="side-menu" class="nav">


           @if(checkPermission(['admin']) || checkPermission(['super']))
                    <li class="user-panel">
                        <div class="thumb"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" alt="" class="img-circle"/></div>
                        <div class="info"><p>LOGISTICS</p>
                            <ul class="list-inline list-unstyled">
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li></li>
                    <li class="active"><a href="{{url('/dashboard')}}"><i class="fa fa-home">
                                <div class="icon-bg bg-orange"></div>
                            </i><span class="menu-title">Dashboard</span></a></li>

                    <li><a href="#"><i class="fa fa-user">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Manage Vendor</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{route('vendor_list')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Vendor List</span></a></li>
                            <li><a href="{{route('vendor_create')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Add New</span></a></li>
                            <li><a href="{{route('delivery_charge_create')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Add Delivery Charge</span></a></li>
                            <li><a href="{{route('delivery_charge_view_data')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Update Delivery Charge</span></a></li>
                        </ul>
                    </li>

                    <li><a href="#"><i class="fa fa-shopping-cart">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Manage Order</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{route('approve_order_list')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Approved Order List</span></a></li>
                            <li><a href="{{route('admin_pending_order_list')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Pending Order List</span></a></li>
                            <li><a href="{{route('rejected_order_lists')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Rejected Order List</span></a></li>
                            <li><a href="{{route('assign_order')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Assign Order</span></a></li>
                            <li><a href="{{route('rating')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Rating</span></a></li>
                        </ul>
                    </li>

                    <li><a href="#"><i class="fa fa-money">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Manage Payments</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{route('payment.vendor_wise_history')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Payment History</span></a></li>
                            <li><a href="{{route('payment.receive_payment')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Receive Payment</span></a></li>
                            <li><a href="{{route('payment.payment_to_vendor')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Payment to Vendor</span></a></li>
                            <li><a href="{{route('payment.driver_wise_history')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Driver History</span></a></li>
                            <li><a href="{{route('payment.payment_to_driver')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Payment to Driver</span></a></li>
                        </ul>
                    </li>

                    <li><a href="#"><i class="fa fa-user">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Manage Employee</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{route('employee.index')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Employee List</span></a></li>
                            <li><a href="{{route('employee.driver_index')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Driver List</span></a></li>
                            <li><a href="{{route('employee.create')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Add New</span></a></li>
                        </ul>
                    </li>

                    <li><a href="#"><i class="fa fa-cogs">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Settings</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level @if($url === 'area.index' || $url === 'zone.index' || $url === 'location.index' || $url === 'area.show' || $url==='zone.show' )  {{'in'}} @endif">
                            <li><a href="{{route('area.index')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Area</span></a></li>
                            <li><a href="{{route('zone.index')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Zone</span></a></li>
                            <li><a href="{{route('location.index')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Location</span></a></li>
                            <li><a href="{{route('office')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Branch</span></a></li>
                            <li><a href="{{route('company.info')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Company Information</span></a></li>
                            <li><a href="{{route('driverCharge')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Driver Charge</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-file" aria-hidden="true">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Report</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level @if($url === 'area.index' || $url === 'zone.index' || $url === 'location.index' || $url === 'area.show' || $url==='zone.show' )  {{'in'}} @endif">
                            <li><a href="{{route('report.employee_list')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Employee List</span></a></li>
                            <li><a href="{{route('report.vendor.feedback')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Vendor Feedback</span></a></li>
                            <li><a href="{{route('report.vendor_list_view')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Vendor List</span></a></li>
                            <li><a href="{{route('report.vendor_wise_order_history')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Vendor Wise Order History </span></a></li>
                            <li><a href="{{route('report.driver_wise_order_history')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Driver Wise Order History </span></a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('search.order.id')}}"><i class="fa fa-search"><div class="icon-bg bg-red"></div></i><span class="menu-title">Search Order</span></a></li>
            @endif

            @if(checkPermission(['vendor']))
                   <li class="user-panel">
                       <div class="thumb"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" alt="" class="img-circle"/></div>
                       <div class="info"><p>LOGISTICS</p>
                           <ul class="list-inline list-unstyled">
                           </ul>
                       </div>
                       <div class="clearfix"></div>
                   </li>
                   <li class="active"><a href="{{url('/dashboard')}}"><i class="fa fa-home">
                               <div class="icon-bg bg-orange"></div>
                           </i><span class="menu-title">Dashboard</span></a></li>
                   <li><a href="#"><i class="fa fa-shopping-cart">
                               <div class="icon-bg bg-pink"></div>
                           </i><span class="menu-title">Manage Order</span><span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a href="{{route('order_new')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Add New Order</span></a></li>
                       </ul>
                   </li>


                   <li><a href="#"><i class="fa fa-shopping-cart">
                               <div class="icon-bg bg-pink"></div>
                           </i><span class="menu-title">Pending Order List</span><span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a href="{{route('pending_order_list')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Pending Order List</span></a></li>
                       </ul>
                   </li>


                   <li><a href="#"><i class="fa fa-shopping-cart">
                               <div class="icon-bg bg-pink"></div>
                           </i><span class="menu-title">Approved Order List</span><span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a href="{{url('approve/order/lists')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Approved Order List</span></a></li>
                       </ul>
                   </li>


                   <li><a href="#"><i class="fa fa-shopping-cart">
                               <div class="icon-bg bg-pink"></div>
                           </i><span class="menu-title">Track Order</span><span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a href="{{route('vendor.track.order')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Track Order</span></a></li>
                       </ul>
                   </li>

                   <li><a href="#"><i class="fa fa-shopping-cart">
                               <div class="icon-bg bg-pink"></div>
                           </i><span class="menu-title">Transactions History</span><span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a href="{{route('vendor_transaction_history')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Transaction History</span></a></li>
                       </ul>
                   </li>


                   <li><a href="#"><i class="fa fa-star">
                               <div class="icon-bg bg-pink"></div>
                           </i><span class="menu-title">Rating</span><span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a href="{{route('rating.order.vendor')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Admin Rating</span></a></li>
                       </ul>
                   </li>

            @endif
        </ul>
    </div>
</nav>