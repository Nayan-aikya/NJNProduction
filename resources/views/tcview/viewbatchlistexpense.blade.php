<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >

@extends('layouts.sidebar')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
    #viewbatchlistcontainer{
        margin-top: 5%;
        margin-bottom: 2%;
    }

</style>
 <div class="row" id="viewbatchlistcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.sidebar')
        </div>
        <!-- main content -->
        <div id="viewtargetcontent" class="col-md-9">
        <h1 style="color: #b30000;">List Of Completed Batches</h1>
        @if(session()->has('message'))
           
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session()->get('message') }}
              </div>
        @endif
        <table class="table table-bordered">
        <tr><th rowspan="2">Batch Id</th>
            <th rowspan="2">Batch Name</th>
            <th rowspan="2">Batch Type</th>
            <th rowspan="2">Status</th>
            <th colspan="3">Expense</th>
            <th rowspan="2">Total</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr>
          <td>Stipend</td>
          <td>Raw material</td>
          <td>Institutional Expenditure</td>  
        </tr>
       

            @foreach($batchinfo as $row)
             <form action="{{ url('batchexpensetotal', $row->id) }}" method="post">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $row->id }}">

            <?php $stipend = "stipend".$row->id;
                    $raw = "raw".$row->id;
                    $inst_exp = "inst_exp".$row->id;
                    $total = "total".$row->id;
             ?>
            <tr>
                <td>{{$row->batch_id}}</td>
                <td>{{$row->batch_name}}</td>
                <td>{{$row->batch_type}}</td>
                <td>{{$row->action}}</td> 
                <td> <input OnChange="av(<?php echo $row->id; ?>)" class="tinf" type="number" name="stipend" id="{{ $stipend }}" value="{{ $row->stipend }}"></td>
                <td><input OnChange="av(<?php echo $row->id; ?>)" class="tinf" type="number" name="raw_material" id = "{{ $raw }}" value="{{ $row->raw_material }}"></td>
                <td><input OnChange="av(<?php echo $row->id; ?>)" class="tinf" type="number" name="inst_exp" id = "{{ $inst_exp }}" value="{{ $row->inst_exp }}"></td>
                <td><input required class="tinf" type="number" name="total" id="{{ $total }}" value="{{ $row->total_expense }}" readonly> </td>
                    <td><input class="btn btn-primary" type="submit" name="Submit" value="Submit" ></td>
</td>         
            </tr>
               </form>
            @endforeach
     
        </table>
        </div>
</div> 
<script type="text/javascript">
function av(avSelect)
{
    
    var one=document.getElementById("stipend"+avSelect).value;
    var two=document.getElementById("raw"+avSelect).value;
    var three=document.getElementById("inst_exp"+avSelect).value;
    var avvy=Number(one)+Number(two)+Number(three);
    document.getElementById("total"+avSelect).value = avvy;


}



</script>  
@stop
