

@if(checkPermission(['admin']) || checkPermission(['super']))
<li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-bell fa-fw"></i><span class="badge badge-green">{{$pending_order_notify_count}}</span></a>
    <ul class="dropdown-menu dropdown-alerts">
        <li><p>You have {{$pending_order_notify_count}} new Order</p></li>
        <li>
            <div class="dropdown-slimscroll">
                <ul>
                    @foreach($count_pending_order as $count_pending)
                        <li><a href="{{route('pending_notification_list',$count_pending->vendor_id)}}"><span class="label label-green"><i class="fa fa-shopping-cart"></i></span> <b>{{$count_pending->name}}</b> has {{$count_pending->order_count}} Pending Order <span class="pull-right text-muted small">{{ \Carbon\Carbon::parse($count_pending->created_at)->diffForHumans() }}</span> </a></li>
                    @endforeach
                </ul>
            </div>
        </li>
    </ul>
</li>
@endif