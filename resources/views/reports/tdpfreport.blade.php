
@extends('layouts.sidebar')
@section('content')
<style type="text/css">
    #viewbatchlistcontainer{
        margin-top: 5%;
        margin-bottom: 2%;
    }
/*  .table td {
  max-width: 35px;
  word-wrap: break-word;
  }*/
</style>
<div class="row" id="viewbatchlistcontainer">
        <!-- sidebar content -->
        <div id="sidebar" class="col-md-3">
            @include('includes.tdsidebar')
        </div>
        <!-- main content -->
<div id="viewtargetcontent" class="col-md-9">
<div class="row" >
<div class="col-sm-4" style="margin-left:4%;">
              <label for="usr">Academic Year</label>
              <select class="form-control" id="sel1" name="fiscalyear" required>
              <option value="">-----Select Academic Year-----</option>
              @foreach ($academicyear as $key )
              <option value="{{ $key->academic_year }}"  {{( $key->academic_year == $acyear ) ? 'selected' : ''}} >{{ $key->academic_year }}</option>
              @endforeach
              </select>
</div>
<div class="col-sm-4" style=" margin-left:5%;">
              <label for="usr">Training Center</label>
              <select class="form-control" id="sel1" name="tc" required>
              <option value="">-----Select Training Centre-----</option>
              <option value="all" selected>All</option>
              @foreach ($tc as $key )
              <option value="{{ $key->centre_id }}">{{ $key->centre_name }}</option>
              @endforeach
              </select>
</div>
<div class="col-sm-2" style=" margin-left:7%;margin-top:3%;">
<input type="button" class="btn btn-primary" id="create_pdf" value="Generate PDF"> 
</div>
</div>
<div class="row form">
<div class="col-sm-8" >
<h1 style="color: #b30000;">Report</h1>
<div class="response" id="view">
<table id="exportTable" class="table table-bordered">
  <tr><th>Centre Id</th><th>Centre Name</th><th>District</th><th>Batch Id</th><th>Batch Name</th><th>Training Subject</th><th colspan="3">Physical Target</th><th colspan="3">Financial Target</th></tr>
  <tr><th></th><th></th><th></th><th></th><th></th><th></th><th>Male Total</th><th>Female Total</th><th>Total</th><th>Male Total</th><th>Female Total</th><th>Total</th></tr>
  @foreach ($physicalinfo as $p)
  <tr><td>{{ $p->centre_id }}</td><td>{{ $p->centre_name }}</td><td>{{ $p->district }}</td><td>{{ $p->batch_id }}</td><td>{{ $p->batch_name }}</td><td>{{ $p->batch_type }}</td><td>{{ $p-> phy_male }}</td><td>{{ $p-> phy_female }}</td><td>{{ $p-> phy_total }}</td><td>{{ $p->fin_male }}</td><td>{{ $p->fin_female }}</td><td>{{ $p->fin_total }}</td></tr>
  @endforeach
</table>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="fiscalyear"]').on('change', function() {
          $('select[name="tc"]').val(0);
        });
        $('select[name="tc"]').on('change', function() {
            var tc = $(this).val();
            var fiscalyear = $("select[name='fiscalyear']").val();
            if(tc) {
              var row = '<table class="table table-bordered"  id="exportTable"><tr><th>Centre ID</th><th>Centre Name</th><th>District</th><th>Batch Id</th><th>Batch Name</th><th>Training Type</th><th colspan="3">Physical Target</th><th colspan="3">Financial Target</th></tr><tr><th></th><th></th><th></th><th></th><th></th><th></th><th>Male Total</th><th>Female Total</th><th>Total</th><th>Male Total</th><th>Female Total</th><th>Total</th></tr>';
                $.ajax({
                    url: '/pfreport/'+tc+'/'+fiscalyear,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {    
                    // alert(JSON.stringify(data));                   
                      $.each(data, function (i, item) {
                        // alert(data[i].centre_id);
                    row += '<tr><td>' + data[i].centre_id + '</td><td>' + data[i].centre_name + '</td><td>' + data[i].district + '</td><td>' + data[i].batch_id + '</<td><td>' + data[i].batch_name + '</td><td>' + data[i].batch_type + '</td><td>' + data[i].phy_male + '</td><td>'+ data[i].phy_female + '</td><td>'+ data[i].phy_total + '</td><td>' + data[i].fin_male + '</td><td>'+ data[i].fin_female + '</td><td>'+ data[i].fin_total +'</td></tr>';
                });
                      row+='</table>';
                      // alert(row);
                $('div.response').html('');
                $('#view').append(row);
                
                    }

                });
                
            }
            else{                
            }
        });
    });
  </script>
<script src="{{asset('js/script.js')}}"></script>
<script>

    $('#create_pdf').on('click', function () {  
    var doc = new jsPDF('l', 'pt', 'a4');
   // doc.text("From HTML", 40, 50);
    //doc.text( 40, 50);
    var res = doc.autoTableHtmlToJson(document.getElementById("exportTable"));
    doc.autoTable(res.columns, res.data, {
      startY: 60
    });
    //return doc;

    //doc.autoTable(columns, rows, {
    //  theme: "grid",
    //  margin: 10,
    //  styles: {
    //    font: "courier",
    //    fontSize: 12,
    //    // overflow: "linebreak",
    //    rowHeight: 8,
    //    cellPadding: 1,
    //    halign: "left"
    //  }
    //});
    doc.save();
    });
  </script>
@stop
