@extends('layouts.app')
@section('title', 'User List')

@section('content')


    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">ข้อมูลโปรไฟล์</h2>
    </div>
    <div class="card-body">
              <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                <table id="data" class="table table-hover">
                  <thead>
                    <tr>
                      <!-- <th></th> -->
                      <th>เลขบัตรประชาชน</th> 
                      <!-- <th>คำนำหน้า</th>        -->
                      <th>ชื่อ</th>
                      <th>นามสกุล</th>        
                      <th>โทร</th>  
                      <th>โรงเรียน</th>  
                      <th>วุฒิการศึกษา</th>
                      <th hidden></th>                  
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($profiles as $p)
                    <tr onclick="m_lunch({{$p->id}})">
                      <!-- <td align="center"> -->
                        <!-- <button onclick="m_lunch({{$p->id}})" class="btn btn-sm btn-dark"><i class="fa fa-edit"></i> </button> -->
                        <!-- <a onclick="m_lunch({{$p->id}})"><i class="fa fa-edit"></i> </a> -->
                        <!-- <a onclick="m_view({{$p->id}})"><i class="fa fa-eye"></i></a> -->
                      <!-- </td> -->
                      <td width="200"><i class="fa fa-id-card-alt"></i> {{ citizen($p->citizen_id) }}</td>
                      <!-- <td>{{$p->prefix}}</td> -->
                      <td>{{$p->firstname}}</td>
                      <td>{{$p->lastname}}</td>
                      <td>{{$p->telephone}}</td>
                      <td>{{$p->school}}</td>
                      <td>{{$p->edu_type}}</td>
                      <td hidden>{{$p->citizen_id}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>    
                </div>

            </div>         
              </div>
    </div>

<!-- modal zone -->
<div id="modal_edit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><div id="m-head"></div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <h5><i class="fa fa-id-card-alt"></i> ข้อมูลส่วนตัว</h5>
  <form id="form-data" action="javascript:void(0)">
        <div class="form-row">
          <div class="form-group col-md-2">
            <label>คำนำหน้า</label>
            <input type="text" required class="form-control" id="m-prefix" placeholder="คำนำหน้า">
          </div>
          <div class="form-group col-md-3">
            <label >ชื่อจริง</label>
            <input type="text" required class="form-control" id="m-firstname" placeholder="บางมด">
          </div>
          <div class="form-group col-md-3">
            <label >นามสกุล</label>
            <input type="text" required class="form-control" id="m-lastname" placeholder="รักเรียน">
          </div>
          <div class="form-group col-md-4">
            <label >อีเมล</label>
            <input type="email" required id='m-email' class="form-control" placeholder="Email">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-3">
            <label>Facebook</label>
            <input type="text" class="form-control" id="facebook"  placeholder="Facebook">
          </div>
          <div class="form-group col-md-3">
            <label >Line ID</label>
            <input type="text" id='line' class="form-control" placeholder="Line ID">
          </div>
          <div class="form-group col-md-3">
            <label >หมายเลขโทรศัพท์</label>
            <input type="text" maxlength="10" class="form-control" id="telephone" placeholder="หมายเลขโทรศัพท์">
          </div>
          <div class="form-group col-md-3">
            <label >หมายเลขโทรศัพท์สำรอง</label>
            <input type="text" maxlength="10" class="form-control" id="telephone2" placeholder="หมายเลขโทรศัพท์สำรอง">
          </div>
        </div>

        <h5><i class="fa fa-map-marked-alt"></i> ข้อมูลที่อยู่อาศัย </h5><!-- :: ข้อมูลตามบัตรประชาชน<br> --><br>

        <div class="form-row">
          <div class="form-group col-md-12">
            <label>ที่อยู่</label>
            <textarea class="form-control" rows="2" id="address"></textarea>
            
          </div>
        </div>
      <h5><i class="fa fa-university"></i> ข้อมูลโรงเรียน</h5>
        <div class="form-row">
           <div class="form-group col-md-8">
            <label >ชื่อโรงเรียน</label>
            <input type="text" required="" class="form-control" id="school" autocomplete="no">
          </div>
          <div class="form-group col-md-2">
            <label>จังหวัด</label>
            <input type="text" required class="form-control" id="province" autocomplete="no">
          </div>
          <div class="form-group col-md-2">
            <label >วุฒิการศึกษา</label>
            <select class="form-control" id="edu_type">
              <option id="edu_type_op"></option>
              <option>มัธยมศึกษาปีที่ 6</option>
              <option>ประกาศนียบัตรวิชาชีพ (ปวช.)</option>
              <option>ประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.)</option>
              <option>GED</option>
              <option>IGCSE</option>
              <option></option>
            </select>
          </div>
         </div>
        <h5><i class="fa fa-file"></i> ผลการเรียน/หน่วยกิต</h5>
         <div class="table-responsive">
         <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="20%">รายการ</th>
              <th width="40%">ผลการเรียน</th>
              <th>หน่วยกิต</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>คณิตศาตร์</td>
              <td><input type="number" step="0.01" min="0" max="4" class="form-control" id="GPA_MTH"></td>
              <td><input type="number" step="0.1" class="form-control" id="CRE_MTH" ></td>
            </tr> 
            <tr>
              <td>วิทยาศาสตร์</td>
              <td><input type="number" step="0.01" min="0" max="4" class="form-control" id="GPA_SCI"></td>
              <td><input type="number" step="0.1" class="form-control" id="CRE_SCI" ></td>
            </tr>            
            <tr>
              <td>ภาษาต่างประเทศ</td>
             <td><input type="number" step="0.01" min="0" max="4" class="form-control" id="GPA_ENG" ></td>
             <td><input type="number" step="0.1" class="form-control" id="CRE_ENG" ></td>
            </tr> 
            <tr>
              <td>GPAX</td>
             <td colspan='2'><input type="number" step="0.01" min="0" max="4" class="form-control" id="GPAX"></td>
            </tr> 
          </tbody>
         </table>
         </div>

         <h5><i class="fa fa-globe-asia"></i> ผลการทดสอบทางภาษา <small>* หากไม่มี ไม่ต้องกรอก</small></h5>
         <div class="form-row">
           <div class="form-group col-md-1">
            <label >IELTS</label>
            <input type="text" class="form-control" placeholder="" id="IELTS">
          </div>
          <div class="form-group col-md-1">
            <label >TOEFL</label>
            <input type="text" class="form-control" placeholder="" id="TOEFL" >
          </div>
          <div class="form-group col-md-1">
            <label >TOEIC</label>
            <input type="text"  class="form-control" placeholder="" id="TOEIC" >
          </div>
          <div class="form-group col-md-1">
            <label >CU-TEP</label>
            <input type="text" class="form-control" placeholder="" id="CUTEP">
          </div>
         </div>

         <div class="form-row">
          <div class="form-group col-md-12">
            <label>Feedback to Student</label>
            <textarea class="form-control" rows="2" id="feedback"></textarea>
            
          </div>
        </div>

         <div id="transcript"></div>


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
  $("#data").DataTable({
    "pageLength": 50
  })
  var _id = 0
  var _uid = 0

  function m_lunch(id){
    _id = id
    var _token = $('input[name="_token"]').val()
    
    $.ajax({
      url: '/api/profile',
      type: 'POST',
      async: false,
      data: {id:id,_token:_token},
      success: function(resp){
        var r = resp[0]
        _uid = r.user_id
        $("#m-head").html("<i class='fa fa-edit'></i> "+r.prefix+r.firstname+" "+r.lastname)
        $("#m-prefix").val(r.prefix) 
        $("#m-firstname").val(r.firstname)
        $("#m-lastname").val(r.lastname) 
        $("#m-email").val(r.email)
        $("#facebook").val(r.facebook) 
        $("#line").val(r.lineID)
        $("#telephone").val(r.telephone) 
        $("#telephone2").val(r.telephone2)
        $("#address").html(r.address) 
        $("#school").val(r.school) 
        $("#province").val(r.province)
        $("#edu_type_op").text(r.edu_type) 
        $("#GPAX").val(r.GPAX)
        $("#GPA_MTH").val(r.GPA_MTH) 
        $("#GPA_SCI").val(r.GPA_SCI)
        $("#GPA_ENG").val(r.GPA_ENG) 
        $("#CRE_MTH").val(r.CRE_MTH)
        $("#CRE_SCI").val(r.CRE_SCI) 
        $("#CRE_ENG").val(r.CRE_ENG)
        $("#IELTS").val(r.IELTS)
        $("#TOEFL").val(r.TOEFL)
        $("#TOEIC").val(r.TOEIC)
        $("#CUTEP").val(r.CUTEP)
        $("#transcript").html("Transcript Link :: "+ "<a target='_blank' href='{{env('BASE_FILE_STORAGE')}}/"+r.transcript+"'>"+r.transcript+"</a>")
        $('#feedback').val(r.feedback)
      }
    })
    $('#modal_edit').modal('show')
  }

  $("#form-data").submit(function(){
    var _token = $('input[name="_token"]').val()
    $.ajax({
      url: '/api/updatestudentprofile',
      type: 'POST',
      data: {
        _token:_token,
        _id:_id,
        prefix:$("#m-prefix").val(),
        firstname: $("#m-firstname").val(),
        lastname: $("#m-lastname").val(),
        email: $("#m-email").val(),
        facebook: $("#facebook").val(),
        lineID:$("#line").val(),
        telephone:$("#telephone").val(),
        telephone2:$("#telephone2").val(),
        address:$("#address").val(),
        school:$("#school").val(),
        province:$("#province").val(),
        edu_type:$("#edu_type").val(),
        GPAX:$("#GPAX").val(),
        GPA_MTH:$("#GPA_MTH").val(),
        GPA_SCI:$("#GPA_SCI").val(),
        GPA_ENG:$("#GPA_ENG").val(),
        CRE_MTH:$("#CRE_MTH").val(),
        CRE_SCI:$("#CRE_SCI").val(),
        CRE_ENG:$("#CRE_ENG").val(),
        IELTS:$("#IELTS").val(),
        TOEFL:$("#TOEFL").val(),
        TOEIC:$("#TOEIC").val(),
        CUTEP:$("#CUTEP").val(),
        feedback:$("#feedback").val(),
        _uid:_uid,
      },
      success: function(resp){
        $('#modal_edit').modal('hide')
        if(resp.status == 200){
          swal("บันทึกสำเร็จ",'',"success")
        }else{
          swal("บันทึกไม่สำเร็จ", '','error')
        }
        
      }
    })
  })

</script>

@php
  function citizen($n){
    $arr = str_split($n);
    if(count($arr) == 13){
      $run = 0;
          for($i=0;$i<=16;$i++){
            if($i == 1 || $i == 6 || $i == 12 || $i == 15){
              $ci[$i] = '-';
            }else{
              $ci[$i] = $arr[$run];
              $run++; 
            }
          }
          for($i=0;$i<=16;$i++){
            echo $ci[$i];
          }
    }else{ 
      echo $n;
    }
  }
@endphp

@endsection
