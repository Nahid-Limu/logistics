<select id="zone" name="zone" class="form-control">
        <option value="">Select Zone</option>
    @foreach($zones as $z)
        <option value="{{$z->id}}">{{$z->name}}</option>
    @endforeach
</select>