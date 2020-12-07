@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">จัดการภาควิชา <a href="/admin/department-manage"><i class="fa fa-sync-alt"></i></a></h2>
    </div>
    <div class="card-body">
      <h4>เพิ่มภาควิชา</h4>
      <form method="post" action="">
        @csrf
        @if ($errors->any())
          <div class="alert alert-danger" style="line-height: 1.5rem;">
            เกิดข้อผิดพลาด<br>              
                  @foreach ($errors->all() as $error)
                     &times; {{ $error }}<br>
                  @endforeach
          </div>
        @endif
        <div class="form-row">
          <div class="form-group col-md-3">
            <label>คณะ</label>
            <select class="form-control" name="faculty">
              @foreach($faculty as $f)
                <option value="{{$f->id}}">{{$f->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>ภาควิชา</label>
            <input type="text" class="form-control" name="department" placeholder="ภาควิชา">
          </div>
          <div class="form-group col-md-3">
            <label>สาขาวิชา</label>
            <input type="text" class="form-control" name="major" placeholder="สาขาวิชา">
          </div>
          <div class="form-group col-md-2">
            <label>ADMIN</label>
            <select name="admin" class="form-control">
                <option value="null"> - เลือก -</option>
              @foreach($users as $u)
                <option value="{{$u->id}}">{{$u->username}} - {{$u->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-1">
            <label>บันทึก</label><br>
            <button class="btn btn-primary btn-block">บันทึก</button>
          </div>
        </div>
      </form>
      <hr>
      <div class="alert alert-light">
        <text id="status">API Status: Prepared</text>
      </div>
        <div class="table-responsive">
          <table id="deptTable" class="table table-bordered">
            <thead>
            <tr>
              <!-- <th></th> -->
              <!-- <th>ลำดับ</th> -->
              <th>คณะ</th>
              <th>ภาควิชา</th>
              <th>สาขาวิชา</th>
              <th>ADMIN</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($dept as $d)
              <tr>
                <!-- <td><button onclick="swal('Oops!','This feature will be developing','warning')" class="btn btn-sm btn-danger">X</button></td> -->
                <!-- <td align="center">{{$d->d_id}}</td> -->
                <td>{{$d->f_name}}</td>
                <td>{{$d->d_name}} @if($d->d_name == null) -  @endif</td>
                <td>{{$d->d_major}}</td>
                <td>
                  <select id="{{$d->d_id}}" style="height: 20px; font-size: 14px; border-radius: 5px;" onchange="updateAdmin({{$d->d_id}},'{{$d->d_major}}')" class="">
                    @if($d->user == null)
                      <option value="0"> - เลือก -</option>
                    @else
                      <option value="{{$d->user}}">{{$d->user}}</option>
                    @endif
                      <option value="null">:: ยกเลิกการตั้งค่า</option>
                    @foreach($users as $u)
                      <option value="{{$u->id}}">{{$u->username}} - {{$u->name}}</option>
                    @endforeach
                  </select>
                </td>
                <td><text id="icon{{$d->d_id}}"></text></td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
    </div>

<!-- </div> -->

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $("#deptTable").DataTable({
    "pageLength": 25
  })
</script>
<script type="text/javascript">
  function updateAdmin(id,name){
    var _token = $('input[name="_token"]').val()
    var user = $("#"+id).val()
    var dept_id = id
    $("#status").html("API Status: สาขาวิชา => "+name+" ( "+id+" ) ADMINID => "+user+"")
    $("#icon"+id).html("<font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    $.ajax({
      url : '/api/update-admin-department',
      type: 'POST',
      data:{_token:_token,user:user,dept_id:dept_id},
      success: function(resp){
        $("#icon"+id).html("<font color='green'><i class='fa fa-check'></i></font>")
      }
    })
  }
</script>

@endsection
