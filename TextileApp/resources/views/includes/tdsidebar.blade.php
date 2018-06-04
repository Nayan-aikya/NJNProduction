
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
<div class="sidenav">
  <a href="{{ URL::to('training_center_form') }}">Training Centre</a>
  <a href="{{ URL::to('approvebatch') }}">Approve Batch</a>
  <a href="{{ URL::to('approvetcview')}}">Approve TC</a>
  <a href="{{ URL::to('approvepftarget') }}">Approve Targets</a>
  <!-- <a href="{{ URL::to('approvetargets')}}">Approve Targets</a> -->
  <a href="{{ URL::to('approvebatchexpense')}}">Approve Batch Expense</a>
  <a href="{{ URL::to('viewtc') }}">Training Centre List</a>
  <a href="{{ URL::to('credential') }}">Credential</a>
  <a href="{{ URL::to('role') }}">Create Role</a>
  <a href="{{ URL::to('centretype') }}">Centre Type</a>
  <a href="{{ URL::to('subject') }}">Training Subject</a>
  <a href="{{ URL::to('approveemploymentexpense')}}">Approve Employment Expense</a>
  <a href="{{ URL::to('dashboard') }}">Dashboard</a>
</div>