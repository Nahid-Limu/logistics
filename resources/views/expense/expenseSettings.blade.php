@extends('layouts.master')
@section('title', 'Expense Category')
@section('content')
    <div class="page-content">
        <div class="row">
            @if(Session::has('successMessage'))
                <p id="alert_message" class="alert alert-success">{{Session::get('successMessage')}}</p>
            @endif
            @if(Session::has('failMessage'))
                <p id="alert_message" class="alert alert-danger">{{Session::get('failMessage')}}</p>
            @endif
            <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-9">
                                   <strong><i class="fa fa-list-alt" aria-hidden="true"></i> Expense Categories</strong>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                                <div class="panel-content pagination2 table-responsive">
                                        <table class="table table-bordered  table-dynamic table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Expense Category</th>
                                                <th>Description</th>
                                                <th width="18%">Update/Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($expenseData as $expenseData)
                                                <tr>
                                                    <td>{{$expenseData->categoryName}}</td>
                                                    <td>{{$expenseData->categoryDescription}}</td>
                                                    
                                                    <td>
                                                        <a data-toggle="modal" data-target="#{{$expenseData->id}}" class="btn btn-success btn-sm" type="submit"><i class="fa fa-edit"></i></a>
                                                        <a href="{{ route('expense.delete', $expenseData->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
    
                                                {{--//table end--}}
    
    
                                                {{--//table edit modal start--}}
                                                <div class="modal fade" id="{{$expenseData->id}}" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Update Info</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action=" {{ route('expense.edit')}} " method="post">
                                                                    @csrf
                                                                <div class="form-group">
                    
                                                                    <div class="form-group">
                                                                        <label for="catagoryName">Category Name</label>
                                                                        <input type="text" name="catagoryName" class="form-control form-white" id="catagoryName" value="{{$expenseData->categoryName}}" placeholder="Enter category Name" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="catagoryDescription">Category Description</label>
                                                                        <input type="text" name="catagoryDescription" step="any" class="form-control form-white" id="catagoryDescription" value="{{$expenseData->categoryDescription}}" placeholder="Enter Description" required>
                                                                    </div>
                                                                    
                                                                    <input type="hidden" name="user_name" value="{{auth::user()->name}}">
                                                                    <input type="hidden" name="expense_id" value="{{$expenseData->id}}">
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                    
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="panel-content">
                                            <div class="form-group">
                                                <a data-toggle="modal" data-target="#addLeave" class="btn btn-success btn-md" type="submit"><i class="fa fa-plus"></i> Add Categories</a>
                                                <div class="modal fade" id="addLeave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Add Expense Category</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action=" {{ route('expense.add') }} " method="post">
                                                                    @csrf
                                                                <div class="form-group">
                                                                    <label for="catagoryName">Catagory Name</label>
                                                                    <input type="text" name="catagoryName" class="form-control form-white" id="catagoryName"  placeholder="Enter catagory Name" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="catagoryDescription">Category Description</label>
                                                                    <input type="text" name="catagoryDescription" step="any" class="form-control form-white" id="catagoryDescription"  placeholder="Enter Description" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </div>
                                                                
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
                            

@endsection
@section('extra_js')
    <script>
            
            //flash msg
            $("#alert_message").fadeTo(1000, 500).slideUp(500, function(){
                $("#alert_message").alert('close');
            });
    </script>
@endsection
