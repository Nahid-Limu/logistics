<select id="zoneId" name="zoneId" class="form-control">
    <option value="all" selected="">All</option>
    @foreach($zone_list as $zone)
        <option value="{{$zone->id}}">{{$zone->name}}</option>
    @endforeach
</select>