@extends('layouts.app')
@section('title', 'เพิ่มการรับสมัคร')

@section('content')

@if(isset($status) && $status == 200)
  <script type="text/javascript">swal("บันทึกสำเร็จ", "","success").then(()=>{
    window.location = '/home'
  })</script>
@endif

    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">
          <a href="/profile/home"><font color="#ec6b26">การรับสมัคร</a></font> / 
          <font color="#999">สร้างการรับสมัคร</font></h2>
    </div>
    <div class="card-body">
       @if ($errors->any())
          <div class="alert alert-danger" style="line-height: 1.5rem;">
            เกิดข้อผิดพลาด<br>              
                  @foreach ($errors->all() as $error)
                     &times; {{ $error }}<br>
                  @endforeach
          </div>
        @endif
<div class="row">
  <div class="col-md-12">
    <form method="post" action="">
         @csrf
         <h4><i class="fa fa-file-alt"></i> ข้อมูลการรับสมัคร</h4>
         <div class="form-row">
           <div class="form-group col-md-4">
            <label>คณะ</label>
            <select id="faculty" name='faculty' class="form-control">
              <option value="0">เลือกคณะ ...</option>
              @foreach($faculty as $fac)
                <option value="{{$fac->id}}">{{$fac->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-8">
            <label >สาขาวิชา</label>
            <select id="department" name="department" class="form-control">
              <div id='target'></div>
            </select>
          </div>
         </div>

         <div class="form-row">
           <div class="form-group col-md-1">
            <label>TCAS รอบที่</label>
            <select name='TCAS_ROUND' class="form-control">
              <option>เลือกรอบ ...</option>
              <option>-</option>
              <option>รอบที่ 1</option>
              <option>รอบที่ 2</option>
              <option>รอบที่ 3</option>
              <option>รอบที่ 4</option>
              <option>รอบที่ 5</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label >ชื่อรอบ </label>
            <input type="text" class="form-control" name="name_round" autocomplete="no" placeholder="ชื่อรอบ">
          </div>
          <div class="form-group col-md-2">
            <label >เวลาเปิดรับสมัคร</label>
            <input id="dateOpen" name="openDate" value="{{ date('d-m-Y') }}" class="form-control mb-2"/>
          </div>

          <div class="form-group col-md-2">
            <label >เวลาปิดรับสมัคร</label>
            <input id="dateClose" data-date-format="dd-mm-yyyy" type="text" class="form-control" name="closeDate" autocomplete="off">
          </div>

          <div class="form-group col-md-2">
            <label>จำนวนการรับสมัคร</label>
            <input type="number" class="form-control" required name="amount" autocomplete="off">
          </div>

          <div class="form-group col-md-2">
            <label >เผยแพร่</label><br>
            <input type="radio" name="publish" checked value="1"> สามารถยื่นสมัครได้<br><div style="padding-bottom: 7px;"> </div>
            <input type="radio" name="publish" value="0"> ยังไม่เปิดรับสมัคร
          </div>
         </div>
<hr>
<h4><i class="fa fa-border-all"></i> เกณฑ์การรับสมัคร <small><font color="blue">* หากเกณฑ์ใดที่ไม่กำหนด ไม่ต้องใส่</font></small></h4>

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
              <td>คณิตศาสตร์</td>
              <td><input type="number" step="0.01" min="0" max="4" class="form-control" name="GPA_MTH" ></td>
              <td><input type="number" step="0.1" class="form-control" name="CRE_MTH" ></td>
            </tr> 
            <tr>
              <td>วิทยาศาสตร์</td>
              <td><input type="number" step="0.01" min="0" max="4" class="form-control" name="GPA_SCI" ></td>
              <td><input type="number" step="0.1" class="form-control" name="CRE_SCI" ></td>
            </tr>            
            <tr>
              <td>ภาษาต่างประเทศ</td>
             <td><input type="number" step="0.01" min="0" max="4" class="form-control" name="GPA_ENG" ></td>
             <td><input type="number" step="0.1" class="form-control" name="CRE_ENG" ></td>
            </tr> 
            <tr>
              <td>GPAX</td>
             <td colspan='2'><input type="number" step="0.01" min="0" max="4" class="form-control" name="GPAX" ></td>
            </tr> 
            <tr>
              <td>ผลการทดสอบภาษาอังกฤษ</td>
              <td colspan="2">
                  <input type="radio" name="ENG_TEST"  value="1"> ต้องการ<br><div style="padding-bottom: 7px;"> </div>
            <input type="radio" name="ENG_TEST" checked value="0"> ไม่ต้องการ
              </td>
            </tr>
          </tbody>
         </table>
         </div>    
         <div class="form-row">
           <div class="form-group col-md-12">
            <label>ลิงก์เอกสารการรับสมัครเพิ่มเติม </label>
            <textarea name="link" rows="2" class="form-control"></textarea>
          </div>
         </div> 

         <div class="form-row">
           <div class="form-group col-md-12">
            <label>ประกาศหลังจากสมัคร </label>
            <textarea name="announcement" style="width: 100%" rows="2" class="description"></textarea>
          </div>
         </div>     
<hr>
       <div class="text-right">
         <button type="submit" style="width: 150px;" class="btn btn-dark">บันทึก</button>
       </div>
        
      </form>
  </div>
</div>
       
    </div>
<!-- </div> -->
<script src="https://cdn.tiny.cloud/1/dnbhl6piihjrgbfv441q53e6lroudku9cqqai26pqyxmk676/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    tinymce.init({
        selector:'textarea.description',
        // width: 1200,
        height: 300,
        plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
    });
</script>
<script type="text/javascript">

$('#dateClose').datepicker({
    format: 'dd-mm-yyyy',
});
</script>

<script type="text/javascript">
  $("#faculty").change(()=>{
    var _token = $('input[name="_token"]').val()
    var id = $("#faculty").val()
    $.ajax({
      url: '/api/department',
      method:"POST",
      data:{faculty_id:id, _token:_token},
      success:function(resp){
        $("#department").html("")
        var teks = "<option>โปรดเลือกสาขา</option>"
        var i
        for(i=0;i<resp.length;i++){
          if(resp[i]['department'] == null){
            teks += "<option value='"+resp[i]['id']+"'>" +
            resp[i]['name']+
            "</option>"
          }else{
            teks += "<option value='"+resp[i]['id']+"'>" + resp[i]['department'] + " | "+
            resp[i]['name']+
            "</option>"
          }
        }
        $("#department").append(teks)
      }
    })
  })
</script>


@endsection

