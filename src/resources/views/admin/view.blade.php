@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">สาขาที่เปิดรับสมัคร</h2>
    </div>
    <div class="card-body">

      <button class="btn btn-sm btn-dark"><i class="fa fa-edit"></i></button> = แก้ไขข้อมูล
      <button class="btn btn-sm btn-info"><i class="fa fa-random"></i></button> = ปรับเปลี่ยนสถานะ
      <button class="btn btn-sm btn-warning"><i class="fa fa-bullhorn"></i></button> = ประกาศผล/ปิดโครงการ
      <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button> = ลบการรับสมัคร
      <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                <table id="recruitTable" class="table table-hover" style="line-height: 1.7rem;">
                  <thead>
                    <tr>
                        <!-- <td>ที่</td> -->
                        <th width="7%">TCAS</th>
                        <th width="15%">ชื่อรอบ</th>
                        <th>รหัสการสมัคร</th>
                        <th>คณะ</th>
                        <!-- <th>ภาควิชา</th> -->
                        <th>สาขา</th>
                        <!-- <th>ปิดรับสมัคร</th> -->
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($recruitData as $data)
                    <tr>
                        <!-- <td></td> -->
                        <td>{{$data->TCAS_ROUND}}</td>
                        <td>{{$data->name_round}}</td>
                        <td>#AR{{date('y') + 43}}00{{$data->id}}</td>
                        <td>{{$data->facName}}</td>
                        <!-- <td>{{$data->department}}</td> -->
                        <td>{{$data->deptName}}</td>
                        <!-- <td>{{$data->closeDate}}</td> -->
                        <td>
                          @if($data->publish)
                            <font color="green">Published</font>
                          @else
                            <font color="red">Closed</font>
                          @endif
                        </td>
                        <td width="15%" align="center">
                          <button onclick="edit({{$data->id}})" class="btn btn-sm btn-dark"><i class="fa fa-edit"></i></button>
                          <button onclick="stop({{$data->id}})"class="btn btn-sm btn-info"><i class="fa fa-random"></i></button>
                          <button onclick="closed({{$data->id}})" class="btn btn-sm btn-warning"><i class="fa fa-bullhorn"></i></button>
                          <button onclick="deleteRecruitment({{$data->id}})" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>    
                </div>

            </div>         
              </div>
    </div>
<!-- </div> -->
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <!-- <script src="/vendor/datatables/jquery.dataTables.min.js"></script> -->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/fc-3.3.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/fc-3.3.1/datatables.min.js"></script>

<!-- <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
<script type="text/javascript">
  $("#recruitTable").DataTable({
    "pageLength": 20,
    scrollX:        true,
    scrollCollapse: true,
    // paging:         false,
    fixedColumns:   {
        leftColumns: 0,
        rightColumns: 1
    }
  })
</script>

<script type="text/javascript">
  var deleteRecruitment = (id)=>{
    swal({
   title: "ต้องการลบ #AR"+{{date('y') + 43}}+"00"+id+" หรือไม่ ?",
   text: "หากต้องการลบ จะส่งผลให้ข้อมูลใบสมัครทั้งหมดในสาขานี้หายไป",
   icon: "warning",
   buttons: true,
   dangerMode: true,
 }).then((resp) => {
    if (resp) {
      var _token = $('input[name="_token"]').val()
      $.ajax({
        url:'/api/delete/recruitment/'+id,
        type:'delete',
        data:{_token:_token},
        success:function(resp){
          if(resp.status == 200){
            swal("","ลบสำเร็จ",'success').then(()=>{
              window.location = '/admin/view'
            })
          }else if(resp.status == 404){
            swal("","ไม่สามารถลบได้",'warning')
          }
        }
      })
    }
  })
  }

  var stop = (id)=>{
    var _token = $('input[name="_token"]').val()
    $.ajax({
      url: '/api/stop/recruitment',
      type: 'POST',
       data:{id:id,_token:_token},
       success: function(resp){
        if(resp.status == 200){
          window.location = '/admin/view'
        }
       }
    })
  }

  var edit = (id)=>{
    window.location = '/admin/edit/'+id
  }

function closed(id){
  swal({
   title: "ประกาศผล/ปิดรับสมัคร หรือไม่ ?",
   text: "หากปิดรับสมัครแล้วข้อมูลการรับสมัครจะไปอยู่ในแฟ้มเอกสารเก่า",
   icon: "warning",
   buttons: true,
   dangerMode: true,
 }).then((resp) => {
    if (resp) {
      var _token = $('input[name="_token"]').val()
      $.ajax({
        url:'/api/closed/recruitment',
        type:'POST',
        data:{id:id,_token:_token},
        success:function(resp){
          if(resp.status == 200){
            swal("","ปิดการรับสมัครสำเร็จ",'success').then(()=>{
              window.location = '/admin/view'
            })
          }else if(resp.status == 404){
            swal("","ไม่สามารถปิดได้",'warning')
          }
        }
      })
    }
  })
}

</script>

@endsection
