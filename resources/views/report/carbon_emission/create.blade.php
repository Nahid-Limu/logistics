@extends('layouts.master')
@section('title', 'Add Carbon Emission Report')
@section('content')
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title"><b>Add Carbon Emission Report</b></div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="{{url('/')}}">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Add Carbon Emission Report</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->
    <div class="page-content">
        @if(Session::has('success'))
            <p id="alert_message" class="alert alert-success">{{ Session::get('success') }}</p>
        @endif
        <div class="panel panel-blue">
            <div class="panel-body">
                {{Form::open(['method'=>'POST','route'=>'emission.save'])}}
                <table class="table table-bordered">
                    <tr>
                        <th>Month</th>
                        <th>Value (Minimum 0 to 100 Max)</th>
                    </tr>
                        @foreach($data as $item)
                            <tr>
                                <td>January</td>
                                <td><input autocomplete="off" type="number" min="0" max="100" class="form-control" name="january" value="{{$item->january}}" required></td>
                            </tr>
                            <tr>
                                <td>February</td>
                                <td><input autocomplete="off" min="0" max="100" type="number" class="form-control" name="february" value="{{$item->february}}" required></td>
                            </tr>
                            <tr>
                                <td>March</td>
                                <td><input autocomplete="off" min="0" max="100" type="number" class="form-control" name="march" value="{{$item->march}}" required></td>
                            </tr>
                            <tr>
                                <td>April</td>
                                <td><input autocomplete="off" min="0" max="100" type="number" class="form-control" name="april" value="{{$item->april}}" required></td>
                            </tr>
                            <tr>
                                <td>May</td>
                                <td><input autocomplete="off" min="0" max="100" type="number" class="form-control" name="may" value="{{$item->may}}" required></td>
                            </tr>
                            <tr>
                                <td>June</td>
                                <td><input autocomplete="off" min="0" max="100" type="number" class="form-control" name="june" value="{{$item->june}}" required></td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td><input autocomplete="off" min="0" max="100" type="number" class="form-control" name="july" value="{{$item->july}}" required></td>
                            </tr>
                            <tr>
                                <td>August</td>
                                <td><input autocomplete="off" min="0" max="100" type="number" class="form-control" name="august" value="{{$item->august}}" required></td>
                            </tr>
                            <tr>
                                <td>September</td>
                                <td><input autocomplete="off" min="0" max="100" type="number" class="form-control" name="september" value="{{$item->september}}" required></td>
                            </tr>
                            <tr>
                                <td>October</td>
                                <td><input autocomplete="off" min="0" max="100" type="number" class="form-control" name="october" value="{{$item->october}}" required></td>
                            </tr>
                            <tr>
                                <td>November</td>
                                <td><input autocomplete="off" min="0" max="100" type="number" class="form-control" name="november" value="{{$item->november}}" required></td>
                            </tr>
                            <tr>
                                <td>December</td>
                                <td><input autocomplete="off" min="0" max="100" type="number" class="form-control" name="december" value="{{$item->december}}" required></td>
                            </tr>

                        @endforeach
                        @if($iddata)
                          <input type="hidden" name="id" value="{{$iddata->id}}">
                        @endif
                </table>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
@section('extra_js')
    <script>
        $(document).ready(function() {
            $("#alert_message").fadeTo(1000, 500).slideUp(500, function(){
                $("#alert_message").alert('close');
            });

        } );
    </script>
@endsection