@extends('layouts.master')
@section('title', 'Add Expense')
@section('extra_css')
{{ Html::style('assets/vendors/select2/dist/css/select2.css') }}
@endsection
@section('content')
    <div class="page-content">
        <div class="row">
            @if(Session::has('addExpense'))
                <p id="alert_message" class="alert alert-success">{{Session::get('addExpense')}}</p>
            @endif
             @if(Session::has('deleteExpense'))
                <p id="alert_message" class="alert alert-danger">{{Session::get('deleteExpense')}}</p>
            @endif
            <div class="col-md-12">
                    <div class="panel ">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong><i class="fa fa-money"></i> Add Expense</strong>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                                <div class="row" id='get-form'>
                                        <form action=" {{ route('addDaily.expense') }} " method="post" enctype="multipart/form-data">
                                            @csrf
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required control-label">Expense Category</label>
                                            <div class="option-group">
                                                <select required name="catagoryID" id="catagoryID" class="form-control">
                                                    <option  value="">Select Catagory</option>
                                                    @foreach($catagory as $catagory)
                                                        <option  value="{{$catagory->id}}">{{$catagory->categoryName}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>     
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required form-label">Expense Reason</label>
                                            <div class="prepend-icon">
                                                <input type="text" id="expenseReason" name="expenseReason" class="form-control" placeholder="Reson of the expense..." required>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required form-label">Enter Amount</label>
                                            <div class="prepend-icon">
                                                <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter amount" required>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required form-label">Enter Date</label>
                                            <div class="prepend-icon">
                                                <input type="text" id="datepicker1" name="date" class="date-picker form-control" value="<?php echo date('m/d/Y'); ?>"  required>
                                                <i class="icon-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                            <div class="form-group">
                                                <label class=" form-label">Enter Reference</label>
                                                <div class="prepend-icon">
                                                    <input type="text" id="reference" name="reference" class="form-control" placeholder="Enter reference..">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                    <label for="attachment">Attachment</label>
                                                    <input type="file" name="attachment" step="any" class="form-control form-white" id="attachment"  placeholder="Upload Attachment (If any)">
                                            </div>
                                        </div>
                                                
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="  form-label">Enter Description</label>
                                                <div class="prepend-icon">
                                                    <textarea type="text-area" id="description" name="description" class="form-control" placeholder="Enter description.."></textarea>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                    <label class="  form-label"></label>
                                                <div class="prepend-icon">
                                                    <button type="submit" class="btn btn-primary center-block"> <i class="fa fa-save"></i> Save Expense</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div> 

                                @if(count($expenseList))
                                <hr>
                        <h3><i class="fa fa-table"></i> <strong>Todays expenses</strong></h3>
                        
                        <div class="panel-content pagination2 table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Reason</th>
                                    <th>Amount</th>
                                    <th>Reference</th>
                                    <th>Description</th>
                                    <th>Time</th>
                                    <th>Attachment</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sum=0
                                    @endphp
                                @foreach($expenseList as $expenseData)
                                @php
                                
                                $sum=$sum+$expenseData->amount;
                                $offset=6*60*60;
                                @endphp
                                    <tr>
                                        <td>{{$expenseData->categoryName}}</td>
                                        <td>{{$expenseData->title}}</td>
                                        <td>{{$expenseData->amount}}</td>
                                        <td>{{$expenseData->reference}}</td>
                                        <td>{{$expenseData->description}}</td>
                                        <td>{{date('h:i  A',strtotime($expenseData->created_at))}}</td>
                                        <td>
                                            @if($expenseData->attachment)
                                                <a target="_blank" href="{{asset('Expense_Attachment/'.$expenseData->attachment)}}"><p><button type="button"class="btn btn-custom-download btn-sm"><i class="fa fa-download"></i> Download Attachment</button></p></a>
                                            @else    
                                                <h5>Not Available</h4>
                                            @endif
                                        </td>
                                        <td>
                                
                                            <a href="{{ route('deleteDaily.expense',$expenseData->listID) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                   
                                    {{--//table end--}}

                                   
                                @endforeach
                                </tbody>
                            </table>
                            @php 
                            function convertNumberToWord($num = false)
                            {
                                $num = str_replace(array(',', ' '), '' , trim($num));
                                if(! $num) {
                                    return false;
                                }
                                $num = (int) $num;
                                $words = array();
                                $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
                                    'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
                                );
                                $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
                                $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
                                    'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
                                    'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
                                );
                                $num_length = strlen($num);
                                $levels = (int) (($num_length + 2) / 3);
                                $max_length = $levels * 3;
                                $num = substr('00' . $num, -$max_length);
                                $num_levels = str_split($num, 3);
                                for ($i = 0; $i < count($num_levels); $i++) {
                                    $levels--;
                                    $hundreds = (int) ($num_levels[$i] / 100);
                                    $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
                                    $tens = (int) ($num_levels[$i] % 100);
                                    $singles = '';
                                    if ( $tens < 20 ) {
                                        $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
                                    } else {
                                        $tens = (int)($tens / 10);
                                        $tens = ' ' . $list2[$tens] . ' ';
                                        $singles = (int) ($num_levels[$i] % 10);
                                        $singles = ' ' . $list1[$singles] . ' ';
                                    }
                                    $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
                                } //end for loop
                                $commas = count($words);
                                if ($commas > 1) {
                                    $commas = $commas - 1;
                                }
                                return implode(' ', $words);
                            }
                            @endphp
                            <h4>Todays total expense is : <strong>{{number_format($sum,2)}}</strong> ({{convertNumberToWord($sum)}}) Taka Only</h4>
                            
                        </div>
                        @endif

                        </div>
                    </div>
                </div>
            
    </div>

    
@endsection
@section('extra_js')
{{ Html::script('assets/vendors/select2/dist/js/select2.js') }}
<script>
  $( function() {

    $( "#datepicker1" ).datepicker({
       dateFormat:'yy-mm-dd',
    });
    $( "#datepicker2" ).datepicker({
       dateFormat:'yy-mm-dd',
    });
    $("#vendorId").select2();
  });
  setTimeout(function() {
    $('#alert_message').fadeOut('fast');
  }, 5000);
</script>
@endsection
