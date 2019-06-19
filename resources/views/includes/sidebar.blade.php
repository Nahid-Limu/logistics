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

                    <li><a href="#"><i class="fa fa-users">
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
                            <li><a href="{{route('vendor.rating')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Vendor Rating</span></a></li>
                            <li><a href="{{route('driver.rating')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Driver Rating</span></a></li>

                        </ul>
                    </li>

                    <li><a href="#"><i class="fa fa-money">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Manage Payments (Vendor)</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{route('payment.vendor_wise_history')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Payment History</span></a></li>
                            <li><a href="{{route('payment.receive_payment')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Receive Payment</span></a></li>
                            <li><a href="{{route('payment.payment_to_vendor')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Payment to Vendor</span></a></li>
                            
                        </ul>
                    </li>

                    <li><a href="#"><i class="fa fa-money">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Manage Payments (Driver)</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            
                            <li><a href="{{route('payment.driver_wise_history')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Driver History</span></a></li>
                            <li><a href="{{route('payment.payment_to_driver')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Payment to Driver</span></a></li>
                        </ul>
                    </li>

                    <li><a href="#"><i class="fa fa-money">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Manage Expense</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            
                            <li><a href="{{route('expense.index')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Daily Expense</span></a></li>
                            <li><a href="{{route('expense.history')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Expense History</span></a></li>
                            <li><a href="{{route('expense.setting')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Expense Setting</span></a></li>
                        </ul>
                    </li>

                    <li><a href="#"><i class="fa fa-usd">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Profit/Loss</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        
                            <li><a href="{{ route('profit.index') }}"><i class="fa fa-angle-right"></i><span class="submenu-title">Profit History</span></a></li>
                            <li><a href="{{ route('profit.profit_date_wise') }}"><i class="fa fa-angle-right"></i><span class="submenu-title">Date Wise Profit History </span></a></li>
                        </ul>
                    </li>

                    <li><a href="#"><i class="fa fa-group">
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
                        <ul class="nav nav-second-level @if($url === 'area.index' || $url === 'zone.index' || $url === 'location.index' || $url === 'area.show' || $url==='zone.show' || $url==='location.show' )  {{'in'}} @endif">
                            <li><a href="{{route('area.index')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Area</span></a></li>
                            <li><a href="{{route('zone.index')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Zone</span></a></li>
                            <li><a href="{{route('location.index')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Location</span></a></li>
                            <li><a href="{{route('office')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Branch</span></a></li>
                            <li><a href="{{route('company.info')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Company Information</span></a></li>
                            <li><a href="{{route('driverChargeOrder')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Order Charge</span></a></li>
                            <li><a href="{{route('driverChargeFuel')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Fuel Cost</span></a></li>
                        </ul>
                    </li>



                    <li><a href="#"><i class="fa fa-file" aria-hidden="true">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Report</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level @if($url === 'report.employee_list' || $url === 'report.vendor.feedback' || $url === 'report.vendor_list_view' || $url === 'report.vendor_wise_order_history' || $url==='report.driver_wise_order_history' || $url==='report.rejected.order' )  {{'in'}} @endif">
                            <li><a href="{{route('report.employee_list')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Employee List</span></a></li>
                            <li><a href="{{route('report.vendor.feedback')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Vendor Feedback</span></a></li>
                            <li><a href="{{route('report.vendor_list_view')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Vendor List</span></a></li>
                            <li><a href="{{route('report.vendor_wise_order_history')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Vendor Wise Order History </span></a></li>
                            <li><a href="{{route('report.driver_wise_order_history')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Driver Wise Order History </span></a></li>
                            <li><a href="{{route('report.rejected.order')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Rejected Order</span></a></li>
                        </ul>
                    </li>


                    <li><a href="{{route('search.order.id')}}"><i class="fa fa-search"><div class="icon-bg bg-red"></div></i><span class="menu-title">Search Order</span></a></li>
                <li><a href="#"><i class="fa fa-globe" aria-hidden="true">
                            <div class="icon-bg bg-pink"></div>
                        </i><span class="menu-title">Manage Website</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level @if($url === 'area.index' || $url === 'zone.index' || $url === 'location.index' || $url === 'area.show' || $url==='zone.show' )  {{'in'}} @endif">
                        <li><a href="{{url('create/emission/report')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Cer Report</span></a></li>
                    </ul>
                </li>
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
                   <li><a href="{{route('order_new')}}"><i class="fa fa-shopping-cart">
                               <div class="icon-bg bg-pink"></div>
                           </i><span class="menu-title">Add New Order</span></a>
                   </li>


                   <li><a href="{{route('pending_order_list')}}"><i class="fa fa-clock-o">
                               <div class="icon-bg bg-pink"></div>
                           </i><span class="menu-title">Pending Order List</span><span class="fa arrow"></span></a>
                       
                   </li>


                   <li><a href="{{url('approve/order/lists')}}"><i class="fa fa-check-circle">
                               <div class="icon-bg bg-pink"></div>
                           </i><span class="menu-title">Approved Order List</span></a>
                       
                   </li>


                   <li><a href="#"><i class="fa fa-map-marker">
                               <div class="icon-bg bg-pink"></div>
                           </i><span class="menu-title">Track Order</span><span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a href="{{route('vendor.track.order')}}"><i class="fa fa-angle-right"></i><span class="submenu-title">Track Order</span></a></li>
                       </ul>
                   </li>

                   <li><a href="#"><i class="fa fa-money">
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