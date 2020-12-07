@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="card-header py-3">
  <h2 class="m-0 font-weight-bold text-primary">SQL Command</h2>
</div>
<div class="card-body">
  <div class="row">
    <div class="col-md-2">
      <h5>SQL type</h5>
        <select class="form-control">
          <option>SELECT</option>
          <option>INSERT</option>
          <option>DELETE</option>
          <option>UPDATE</option>
        </select>
    </div>
    <div class="col-md-10">
      <h5>SQL : </h5>
      <input type="text" id="sql" class="form-control" name="">
    </div>
  </div>


  <!-- <div id="selectProject" style="line-height: 1.5rem;">
    <h5>เลือกโครงการการรับสมัคร</h5>
    <?php $i=1;?>
    @foreach($recuitData as $re)
    <a onclick="listRecruitment('{{$re->name_round}}')" href="#">
      {{$i++}}. 
      {{$re->name_round}}<br>
    </a>
    @endforeach
  </div>

  <hr>

  <div id="recruitmentData">
    <table class="table table-hover table-bordered">
      <tr>
        <td>ID</td>
        <td>Project</td>
      </tr>
    </table>
  </div> -->

</div>

<script
src="https://code.jquery.com/jquery-3.5.1.min.js"
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $("#recruitmentData").hide()

  function listRecruitment(round){
    $("#selectProject").hide("dd")
    $("#recruitmentData").show("dd")
  }

  
</script>
@endsection