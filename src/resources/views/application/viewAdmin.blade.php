@extends('layouts.app')
@section('title', 'ยื่นสมัครตามสาขา')

@section('content')
<?php $error = 0;?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ยื่นสมัครตามสาขา </h6>
    </div>
    <div class="card-body">
    <center style="padding-top: 15px;">
      <h4 style="color: #ec6b26;"><i class="fa fa-file-alt"></i> ใบสมัคร Active Recruitment</h4>
   
      <h5 style="color: #ec6b26;">{{$recruit->facName}} / {{$recruit->department}}</h5>
      <div style="margin-left: 15px; line-height: 1.7rem; color:#000; font-size: 18px;"> {{$recruit->deptName}} :: TCAS {{$recruit->TCAS_ROUND}} :: {{$recruit->name_round}}</div>
      <div style="padding-bottom: 20px;"></div>
    </center>

      <h5 style="color: #ec6b26;">ข้อมูลผู้สมัคร</h5>
        <div style="margin-left: 30px; line-height: 1.7rem; font-size: 18px;">
            <b style="color:#000;">ชื่อ-นามสกุล</b> : {{$profile->firstname." ".$profile->lastname}}<br>
            <b style="color:#000;">เลขบัตรประชาชน</b> : {{$profile->citizen_id}}<br>
            <b style="color:#000;">โรงเรียน</b> : {{$profile->school." จ.".$profile->province}}<br>            
        </div><div style="padding-bottom: 15px;"></div>
    
        <h5 style="color: #ec6b26;">เกณฑ์การรับสมัคร</h5>
     <div class="row">
              <!-- <div class="col-md-3">
                <div style="margin-left: 30px; line-height: 1.7rem; font-size: 18px;">
                    <b style="color:#000;">รหัสการสมัคร</b> : #AR{{date('y') + 43}}00{{$id}}<br>
                    <b style="color:#000;">คณะ </b>:  {{$recruit->facName}}<br>
                    <b style="color:#000;">ภาควิชา </b>:  {{$recruit->department}}<br>
                    <b style="color:#000;">สาขา </b>:  {{$recruit->deptName}}
                </div>
              </div> -->
              <div class="col-md-3">
                <div style="margin-left: 30px; line-height: 1.7rem; font-size: 18px;">
                   @if($profile->GPA_MTH < $recruit->GPA_MTH)<?php $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif 
                    <b style="color:#000;">GPA คณิตศาสตร์</b> : 
                    @if($recruit->GPA_MTH == 0) - @else {{number_format($recruit->GPA_MTH,2)}}  @endif<br>

                    @if($profile->GPA_SCI < $recruit->GPA_SCI)<?php $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif 
                    <b style="color:#000;">GPA วิทยาศาสตร์</b> : 
                    @if($recruit->GPA_SCI == 0) - @else {{number_format($recruit->GPA_SCI,2)}}  @endif<br>

                    @if($profile->GPA_ENG < $recruit->GPA_ENG)<?php  $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif 
                    <b style="color:#000;">GPA ภาษาต่างประเทศ</b> : 
                    @if($recruit->GPA_ENG == 0) - @else {{number_format($recruit->GPA_ENG,2)}} @endif<br>

                    @if($profile->GPAX < $recruit->GPAX)<?php  $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif
                    <b style="color:#000;">GPAX</b> 
                    @if($recruit->GPAX == 0) - @else {{number_format($recruit->GPAX,2)}}  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div style="margin-left: 30px; line-height: 1.7rem; font-size: 18px;">
                    @if($profile->CRE_MTH < $recruit->CRE_MTH)<?php  $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif
                    <b style="color:#000;">หน่วยกิตคณิตศาสตร์</b> : 
                    @if($recruit->CRE_MTH == 0) - @else {{number_format($recruit->CRE_MTH,2)}}  @endif<br>

                    @if($profile->CRE_SCI < $recruit->CRE_SCI)<?php  $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif
                    <b style="color:#000;">หน่วยกิตวิทยาศาสตร์</b> : 
                     @if($recruit->CRE_SCI == 0) - @else {{number_format($recruit->CRE_SCI,2)}}  @endif<br>

                     @if($profile->CRE_ENG < $recruit->CRE_ENG)<?php  $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif
                    <b style="color:#000;">หน่วยกิตภาษาต่างประเทศ</b> : 
                     @if($recruit->CRE_ENG == 0) - @else {{number_format($recruit->CRE_ENG,2)}}  @endif<br>

                    @if($recruit->ENG_TEST) 
                      @if($profile->IELTS != NULL || $profile->TOEFL != NULL || $profile->TOEIC != NULL || $profile->CUTEP != NULL)
                        <font color="green"><i class="fa fa-check"></i></font>
                      @else
                      <?php  $error++;?>
                        <font color="red"><b><i class="fa fa-times"></i></b></font>
                      @endif
                    @else <font color="green"><i class="fa fa-check"></i></font>  @endif
                    <b style="color:#000;">ผลการทดสอบภาษาอังกฤษ</b> : 
                    @if($recruit->ENG_TEST) 
                      ต้องการ 
                    @else 
                      ไม่ต้องการ 
                    @endif
                </div>
              </div>
        </div>
        @if($error > 0)
        <div class="row" style="padding-top: 15px;">
          <div class="col-md-3">
            <div class="alert alert-warning">
          <b style="color:#000;"><i class="fa fa-exclamation-circle"></i> ไม่ผ่านเกณฑ์คัดเลือก {{$error}} เกณฑ์</b>
        </div>
          </div>
        </div>
        @else
          <div class="row" style="padding-top: 15px;">
          <div class="col-md-3">
            <div class="alert alert-success">
          <b style="color:#000;"><i class="fa fa-thumbs-up"></i> ผ่านเกณฑ์ทั้งหมด</b>
        </div>
          </div>
        </div>
        @endif
        <hr>

          <h5 style="color: #ec6b26;">แฟ้มสะสมผลงาน/ผลการเรียน</h5>
          <a href="{{env('BASE_FILE_STORAGE')}}/{{$profile->transcript}}" target="_blank">
            <button class="btn btn-info">ผลการเรียน</button>
          </a>
          <a href="{{env('BASE_PORT_STORAGE')}}/{{$app->portfolio}}" target="_blank">
            <button class="btn btn-info">แฟ้มสะสมผลงาน</button>
          </a>

          <br><br>
    
         <!-- <div class="alert alert-info" style="line-height: 1.5rem;">
           <b>แฟ้มสะสมผลงาน</b> : อัพโหลดด้วยไฟล์ *.pdf  ขนาดไม่เกิน 20MB เท่านั้น และเนื้อหาในแฟ้มสะสมผลงาน ควรตรงกับสาขาวิชาที่จะสมัคร<br>
           <b>Link เอกสารอื่น ๆ </b> : แนะนำให้ใช้ Google Drive / One Drive / Youtube และเปิดการเข้าถึงแบบสาธารณะ
         </div> -->
         <h5><i class="fa fa-upload"></i> แฟ้มสะสมผลงาน/ผลกาเรียน</h5>
         
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>แฟ้มสะสมผลงาน</label>
             <div class="">
              <iframe src='{{env("BASE_PORT_STORAGE")}}/{{$app->portfolio}}' frameborder='0'  height='700' style='width: 100%;'></iframe>
            </div>
          </div>

          <div class="form-group col-md-6">
            <label>ผลการเรียน</label>
             <div class="">
              <iframe src='{{env("BASE_FILE_STORAGE")}}/{{$profile->transcript}}' frameborder='0'  height='700' style='width: 100%;'></iframe>
            </div>
          </div>
        </div>
        
         <div class="form-row">
          <div class="form-group col-md-4">
            <h5 style="color: #ec6b26;">ลิงก์รวมผลงานอื่น ๆ </h5>
            @if($app->link != "")
            <a href="{{$app->link}}" target="_blank">{{$app->link}}</a>
            @else - @endif 
          </div>
        </div>
 <hr><a class="btn btn-primary" href="#" onclick="history.back();"><font size="4"><- กลับหน้าที่แล้ว</font></a>
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>


@endsection
