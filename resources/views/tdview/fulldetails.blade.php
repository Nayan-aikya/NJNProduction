
@extends('layouts.sidebar')
@section('content')
<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
   
 <div class="row" id="viewbatchcontainer">
       
        <h1 align="center" >Past Reports for {{ $district }}</h1><a style="float: right;" class="btn btn-success" href="{{ URL::to('oldreport') }}">Go Back</a><br><br>
        <table class="table table-bordered">
        <tr>           

          <th>Financial Year</th>
          <th>Center Name</th>
          <th>Center ID</th>
          <th>Batch Name</th>
          <th>Batch Start Date</th>
          <th>Batch End Date</th>
          <th>Candidate Name</th>
          <th>Employment Status</th>
          <th>Industry</th>
          <th>Loan</th>
          <th>Self Employed</th>
         
        </tr>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->financial_yr }}</td>
                <td>{{ $row->center_name }}</td>
                <td>{{ $row->center_id }}</td>
                <td>{{ $row->batch_name }}</td>
                <td>{{ $row->batch_start_date }}</td>
                <td>{{ $row->batch_end_date }}</td>
                <td>{{ $row->candidate_name }}</td>
                <td>{{ $row->wage_emp }}</td>
                <td>{{ $row->industry }}</td>
                <td>{{ $row->loan }}</td>
                <td>{{ $row->self_emp }}</td>

            </tr>
            @endforeach
        </table>
        {{ $data->links() }}
</div>
@stop
