@extends('layouts.app')
@section('title', 'Department User List')

@section('content')


    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">จัดการผู้ใช้งาน</h2>
    </div>
    <div class="card-body">
    	<div class="btn btn-primary">สร้างผู้ใช้งาน</div>
    	<hr>
              <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                <table id="recruitTable" class="table table-hover">
                  <thead>
                    <tr>
                    	<!-- <th><input type="checkbox" id="checkmain"></th> -->
                    	<th>ID</th>
                        <th>ชื่อภาควิชา</th>
                        <th>ชื่อผู้ใช้งาน</th>
                        <th>อีเมล</th>
                        <th>ประเภท</th>
                        <!-- <th>จัดการ</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr onclick="m_lunch({{$user->id}},'{{$user->name}} {{$user->lastname}}',{{$user->type}})">
                    	<!-- <td><input type="checkbox" id="c{{$user->id}}" onclick="store({{$user->id}})"></td> -->
                    	<td>{{$user->id}}</td>
                        <td>{{$user->name}} {{$user->lastname}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>@if($user->type==1) <div class="badge badge-danger">ผู้ดูแลระบบ</div>
                        	@elseif($user->type==2) <div class="badge badge-success">ภาควิชา</div> 
                        	@else <div class="badge badge-primary">นักเรียน</div> 
                        	@endif</td>
                        <!-- <td></td> -->
                    </tr>
                    @endforeach
                  </tbody>
                </table>    
                </div>

            </div>         
              </div>
    </div>

<!-- modal zone -->
<div id="_edit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
          <div id="m-head"></div>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <h5><i class="fa fa-id-card-alt"></i> ข้อมูลผู้ใช้งาน</h5>
  <form id="update-data" action="javascript:void(0)">
        <div class="form-row">
          <div class="form-group col-md-12" id="error">
            <div class="alert alert-danger" style="margin: 0px;">
              <b><text id="error_txt"></text></b>
            </div>
          </div>
          <div class="form-group col-md-4">
            <label>คำนำหน้า</label>
            <input type="text" required class="form-control" id="prefix" placeholder="คำนำหน้า">
          </div>
          <div class="form-group col-md-4">
            <label >ชื่อจริง</label>
            <input type="text" required class="form-control" id="firstname" placeholder="บางมด">
          </div>
          <div class="form-group col-md-4">
            <label >นามสกุล</label>
            <input type="text" required class="form-control" id="lastname" placeholder="รักเรียน">
          </div>
          <div class="form-group col-md-6">
            <label >ชื่อผู้ใช้งาน</label>
            <input type="text" required id='username' class="form-control" placeholder="username">
          </div>
          <div class="form-group col-md-6">
            <label >อีเมล</label>
            <input type="email" required id='email' class="form-control" placeholder="Email">
          </div>
          <div class="form-group col-md-5">
            <label >รหัสผ่านใหม่</label>
            <input type="password" id='password' minlength="6" class="form-control" placeholder="new password">
          </div>
          <div class="form-group col-md-5">
            <label >ยืนยันรหัสผ่าน</label>
            <input type="password" id='cfpass' minlength="6" class="form-control" placeholder="confirm password">
          </div>
          <div class="form-group col-md-2">
            <label>Reset</label><br>
            <div onclick="random()" class="btn btn-sm btn-secondary form-control">สุ่มรหัสผ่าน</div>
          </div>
          <div class="form-group col-md-12" id="hint">
            <div class="alert alert-secondary" style="margin: 0px;">
              โปรดจำรหัสผ่าน : <b><text id="password_hint"></text></b>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <label>สิทธิ์การใช้งาน</label>
              <select id="role" class="form-control" name="role">
                <option id="default"></option>
                <option value="0">นักเรียน</option>
                <option value="1">ผู้ดูแลระบบ</option>
                <option value="2">ภาควิชา</option>
              </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
      </div>
    </div>
  </div>
</div>
</form>
@csrf

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $("#recruitTable").DataTable({
    "pageLength": 50
  })

  $("#hint").hide()
  $("#error").hide()

  var password = 0
  var _id = 0
  var send_pass = ''
  function m_lunch(id,name,type){
    $("#hint").hide()
    $("#password").val("")
    $("#cfpass").val("")
    $("#password_hint").text("")
    $("#error").hide()

    _id = id
    var _token = $('input[name="_token"]').val()

    $("#m-head").html("<i class='fa fa-edit'></i> "+name+" ")
    if(type == 1){
      $("#m-head").append('<div class="badge badge-danger">ผู้ดูแลระบบ</div>')
      $("#default").text("ผู้ดูแลระบบ")
    }else if(type == 2){
      $("#m-head").append('<div class="badge badge-success">ภาควิชา</div>')
      $("#default").text("ภาควิชา")
    }else if(type == 0){
      $("#m-head").append('<div class="badge badge-primary">นักเรียน</div>')
      $("#default").text("นักเรียน")
    }

    $("#role").val(type)

    $.ajax({
      url: '/api/user-detail',
      type: 'post',
      data: {_token:_token,id:_id},
      success: function(resp){
        var r = resp[0]
        $("#prefix").val(r.prefix)
        $("#firstname").val(r.name)
        $("#lastname").val(r.lastname)
        $("#email").val(r.email)
        $("#username").val(r.username)
      }
    })

    $('#_edit').modal('show')
  }

  function random(){
      var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%&";
      var string_length = 8;
      var randomstring = '';
      for (var i=0; i<string_length; i++) {
          var rnum = Math.floor(Math.random() * chars.length);
          randomstring += chars.substring(rnum,rnum+1);
      }
      var rand = randomstring
      $("#password").val(rand)
      $("#cfpass").val(rand)
      $("#password_hint").text(rand)
      $("#hint").show("dd")
  }

  $("#update-data").submit(()=>{
    if($("#password").val() != ""){
      if($("#password").val() == $("#cfpass").val()){
        $("#error").hide("dd")
        password = 1
        send_pass = $("#password").val()
        updateData()
      }else{
        $("#error_txt").text("รหัสผ่านไม่ตรงกัน")
        $("#error").show("dd")
      }
    }else{
      updateData()
    }
  })

  function updateData(){
      console.log("saved")
      var _token = $('input[name="_token"]').val()
      $.ajax({
        url: '/api/update-user',
        type: 'POST',
        data: {
          id:_id,
          _token:_token,
          prefix: $("#prefix").val(),
          name: $("#firstname").val(),
          lastname: $("#lastname").val(),
          email: $("#email").val(),
          role: $("#role").val(),
          username:$("#username").val(),
          ps:password,
          password: send_pass
        },
        success: function(resp){
          $('#_edit').modal('hide')
          swal('บันทึกสำเร็จ','','success').then(()=>{
            window.location = '/admin/department-admin'
          })
        }
      })
    }
</script>
@endsection
