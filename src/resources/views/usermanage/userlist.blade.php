@extends('layouts.app')
@section('title', 'User List')

@section('content')


    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">จัดการผู้ใช้งาน</h2>
    </div>
    <div class="card-body">
      <!-- 	<div class="btn btn-primary">สร้างผู้ใช้งาน</div>
      	<hr> -->
              <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                <table id="recruitTable" class="table table-hover">
                  <thead>
                    <tr>
                    	<!-- <th><input type="checkbox" id="checkmain"></th> -->
                    	<th>ID</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ชื่อผู้ใช้งาน</th>
                        <th>อีเมล</th>
                        <th>ประเภท</th>
                        <th>จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                    	<!-- <td><input type="checkbox" id="c{{$user->id}}" onclick="store({{$user->id}})"></td> -->
                    	<td>{{$user->id}}</td>
                        <td>{{$user->name}} {{$user->lastname}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>@if($user->type==1) <div class="badge badge-danger">ผู้ดูแลระบบ</div>
                        	@elseif($user->type==2) <div class="badge badge-success">ภาควิชา</div> 
                        	@else <div class="badge badge-primary">นักเรียน</div> 
                        	@endif</td>
                        <td></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>    
                </div>

            </div>         
              </div>
    </div>
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

  // var storeID = []
  // var state = 0
  // var store = (id) => {
  // 	storeID.push(id)
  // 	console.log(storeID)
  // 	$('#c'+id).attr("onclick", "disstore("+id+")")
  // }

  // var disstore = (id) => {
  // 	storeID.pop(id)
  // 	console.log(storeID)
  // 	$('#c'+id).attr("onclick", "store("+id+")")
  // }

  // $("#checkmain").click(function(){
  // 	if(state == 0){
  // 		$('input[type="checkbox"]').attr("checked", "checked")
  // 		state = 1
  // 	}else{
  // 		$('input[type="checkbox"]').attr("checked", "false")
  // 		state = 0 
  // 	}
  	
  // })
</script>
@endsection
