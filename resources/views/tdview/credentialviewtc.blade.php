<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >

     <table class="table table-bordered">
        <tr>
            <th>Centre&nbspID</th>
            <th>Centre&nbspName</th>
            <th>Owner&nbspName</th>
            <th>District</th>
            <th>Type&nbspof&nbspcentre</th>
            <th>Subject</th>
            <th>Save</th>
        </tr>
        @foreach ($tclist as $tc)
            <tr><td></td></tr>
              @endforeach
    </table>


