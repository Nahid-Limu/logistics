<div class="row pb-r">
    <hr>
    <div class="col-md-11 col-md-offset-1">
        <p class="content_heading">
            <label for="" class="left_label"><i class="fa fa-angle-up"></i></label>
            Driver Basic Information
            <i class="right_label fa fa-info-circle"></i>
        </p>
    </div>
    {{--<div class="col-md-4">--}}
    {{--<a href="#" class="btn edit_btn btn-sm" data-toggle="modal"--}}
    {{--data-target="#editEmployee"><i class="fa fa-edit"></i>Edit</a>--}}
    {{--</div>--}}

    <div class="col-md-8">
        <div class="form-group">
            <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label"> Name : </label>
            <div class="col-md-7 col-sm-8 col-xs-7">
                <p class="form-control-static">{{$driver->name}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Employee ID: </label>

            <div class="col-md-7 col-sm-8 col-xs-7">
                <p class="form-control-static">{{$driver->selsEmployeeId}}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Gender : </label>
            <div class="col-md-7 col-sm-8 col-xs-7">
                <p class="form-control-static">
                    @if($driver->gender==1)
                        Male
                    @else
                        Female
                    @endif
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Mobile Number: </label>

            <div class="col-md-7 col-sm-8 col-xs-7">
                <p class="form-control-static">{{$driver->phone}}</p>
            </div>
        </div>
    </div>


    <div class="col-md-8">
        <div class="form-group">
            <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Area : </label>
            <div class="col-md-7 col-sm-8 col-xs-7">
                <p class="form-control-static">{{$driver->area_name}}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label for="" class="col-md-5 col-sm-4 col-xs-5 control-label">Zone : </label>
            <div class="col-md-7 col-sm-8 col-xs-7">
                <p class="form-control-static">{{$driver->zone_name}}</p>
            </div>
        </div>
    </div>

    <div class="col-md-11 col-md-offset-1">
        <p class="content_heading">
            <label for="" class="left_label"></label>
            <div class="form-check">
                <input type="checkbox" name="zone_id" value="{{$driver->zone_id}}" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" style="padding-left: 16px; position: absolute;top:37px;" for="exampleCheck1">Only orders in same zone</label>
            </div>
        </p>
    </div>




</div>