@extends('layouts.app')
@section('title', 'ยื่นสมัครตามสาขา')

@section('content')
<?php $error = 0;?>
<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">{{trans('word.ap_title')}} </h2>
    </div>
    <div class="card-body">
    <center style="padding-top: 15px;">
      <h4 style="color: #ec6b26;">Active Recruitment</h4>
   
      <h5 style="color: #ec6b26;">@if(Config::get('app.locale') == 'th'){{$recruit->facName}}@else {{$recruit->f_name_en}} @endif @if(Config::get('app.locale') == 'th')/ {{$recruit->department}}@endif</h5>
      <div style="margin-left: 15px; line-height: 1.7rem; color:#000; font-size: 18px;"> @if(Config::get('app.locale') == 'th'){{$recruit->deptName}} @else {{$recruit->d_name_en}} @endif :: {{$recruit->TCAS_ROUND}} :: {{$recruit->name_round}}</div>
      <div style="padding-bottom: 20px;"></div>
    </center>
@if($recruit->publish == 2)
<center>
  <br>
   <h1>Application closed</h1>
   <p>Applications closed on the {{$recruit->closeDate}}</p><br>
   <a href="/{{Config::get('app.locale')}}/apply">Back to apply</a>
  </center>
@else

@if($allow)
      <h5 style="color: #ec6b26;">{{trans('word.ap_profile')}}</h5>
        <div style="margin-left: 30px; line-height: 1.7rem; font-size: 18px;">
            <b style="color:#000;">{{trans('word.ap_name')}}</b> : {{$profile->firstname." ".$profile->lastname}}<br>
            <b style="color:#000;">{{trans('word.ap_citizen')}}</b> : {{$profile->citizen_id}}<br>
            <b style="color:#000;">{{trans('word.ap_school')}}</b> : {{$profile->school." จ.".$profile->province}}<br> 
            <b style="color:#000">{{trans('word.ap_edutype')}}</b> : {{$profile->edu_type}}       
        </div><div style="padding-bottom: 15px;"></div>
    
        <h5 style="color: #ec6b26;">{{trans('word.ap_rule')}}</h5>
        
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
                    <b style="color:#000;">{{trans('word.ap_gpa_mth')}}</b> : 
                    @if($recruit->GPA_MTH == 0) - @else {{number_format($recruit->GPA_MTH,2)}}  @endif<br>

                    @if($profile->GPA_SCI < $recruit->GPA_SCI)<?php $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif 
                    <b style="color:#000;">{{trans('word.ap_gpa_sci')}}</b> : 
                    @if($recruit->GPA_SCI == 0) - @else {{number_format($recruit->GPA_SCI,2)}}  @endif<br>

                    @if($profile->GPA_ENG < $recruit->GPA_ENG)<?php  $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif 
                    <b style="color:#000;">{{trans('word.ap_gpa_eng')}}</b> : 
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
                    <b style="color:#000;">{{trans('word.ap_cre_mth')}}</b> : 
                    @if($recruit->CRE_MTH == 0) - @else {{number_format($recruit->CRE_MTH,2)}}  @endif<br>

                    @if($profile->CRE_SCI < $recruit->CRE_SCI)<?php  $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif
                    <b style="color:#000;">{{trans('word.ap_cre_sci')}}</b> : 
                     @if($recruit->CRE_SCI == 0) - @else {{number_format($recruit->CRE_SCI,2)}}  @endif<br>

                     @if($profile->CRE_ENG < $recruit->CRE_ENG)<?php  $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif
                    <b style="color:#000;">{{trans('word.ap_cre_eng')}}</b> : 
                     @if($recruit->CRE_ENG == 0) - @else {{number_format($recruit->CRE_ENG,2)}}  @endif<br>

                    @if($recruit->ENG_TEST) 
                      @if($profile->IELTS != NULL || $profile->TOEFL != NULL || $profile->TOEIC != NULL || $profile->CUTEP != NULL)
                        <font color="green"><i class="fa fa-check"></i></font>
                      @else
                      <?php  $error++;?>
                        <font color="red"><b><i class="fa fa-times"></i></b></font>
                      @endif
                    @else <font color="green"><i class="fa fa-check"></i></font>  @endif
                    <b style="color:#000;">{{trans('word.ap_eng_test')}}</b> : 
                    @if($recruit->ENG_TEST) 
                      {{trans('word.s_req')}} 
                    @else 
                      {{trans('word.s_not_req')}} 
                    @endif
                </div>
              </div>
        </div>

        @if($error > 0)
        <div class="row" style="padding-top: 15px;">
          <div class="col-md-3">
            <div class="alert alert-warning">
          <b style="color:#000;"><i class="fa fa-exclamation-circle"></i> {{trans('word.ap_fail')}} {{$error}} {{trans('word.ap_rule1')}}@if($error>1 && Config::get('app.locale') == 'en')s @endif</b>
        </div>
          </div>
        </div>
        @else
          <div class="row" style="padding-top: 15px;">
          <div class="col-md-3">
            <div class="alert alert-success">
          <b style="color:#000;"><i class="fa fa-thumbs-up"></i> {{trans('word.ap_success')}}</b>
        </div>
          </div>
        </div>
        @endif


        @if($profile->edu_type == "IGCSE" || $profile->edu_type == "GDE")
           <!--  <div class="alert alert-info" style="width:500px;">
            {{trans('word.ap_gde')}}
            </div> -->
        @endif

        <h5 style="color: #ec6b26;">{{trans('word.ap_recruit_data')}}</h5>
        <div style="margin-left: 30px; line-height: 1.7rem; font-size: 18px;">
          <b style="color:#000">{{trans('word.ap_amount')}}</b> : {{$recruit->amount}} <br>
          <b style="color:#000">{{trans('word.ap_doc')}}</b> : <a href="{{$recruit->link}}" target="_blank">{{trans('word.ap_click')}}</a>
        </div>

        <hr>
      @endif
        


        @if($allow)
          <h5 style="color: #ec6b26;">{{trans('word.ap_upload')}}</h5>
          <div class="alert alert-warning" style="line-height: 1.5rem;">
          <i class="fa fa-exclamation-circle"></i>
          @if(Config::get('app.locale') == 'th')
            <b>โปรดอัพโหลดในขนาดไฟล์ไม่เกิน 20 MB และเป็นไฟล์ PDF เท่านั้น<br> </b>
          @else
            <b>File limited size not over 20MB, and as PDF file only.</b>
          @endif
           
         </div>
                 <form method="post" action="" id="formApply" enctype="multipart/form-data">
         @csrf
         <!-- <div class="alert alert-info" style="line-height: 1.5rem;">
           <b>แฟ้มสะสมผลงาน</b> : อัพโหลดด้วยไฟล์ *.pdf  ขนาดไม่เกิน 20MB เท่านั้น และเนื้อหาในแฟ้มสะสมผลงาน ควรตรงกับสาขาวิชาที่จะสมัคร<br>
           <b>Link เอกสารอื่น ๆ </b> : แนะนำให้ใช้ Google Drive / One Drive / Youtube และเปิดการเข้าถึงแบบสาธารณะ
         </div> -->
          @if ($errors->any())
          <div class="alert alert-danger" style="line-height: 1.5rem;">
            เกิดข้อผิดพลาด<br>              
                  @foreach ($errors->all() as $error)
                     &times; {{ $error }}<br>
                  @endforeach
          </div>
        @endif
         
         
        <div class="form-row">
          <div class="form-group col-md-6">
            <h5><i class="fa fa-upload"></i> {{trans('word.ap_portfolio')}} <font color="red" style="font-size:16px;">* {{trans('word.ap_require')}}</font></h5>
            <input type="file" name="portfolio" required accept="application/pdf" class="form-control">
          </div>

        <!--   <div class="form-group col-md-4">
            <h5><i class="fa fa-upload"></i> {{trans('word.s_alumni')}} <font color="red" style="font-size:16px;">* {{trans('word.ap_require')}}</font></h5>
            <input type="file" name="alumni_doc" required accept="application/pdf" class="form-control">
          </div> -->

          <div class="form-group col-md-6">
            <h5><i class="fa fa-upload"></i> {{trans('word.ap_sop')}} <font color="blue" style="font-size:16px;">({{trans('word.ap_optional')}})</font></h5>
            <input type="file" name="sop" accept="application/pdf" class="form-control">
          </div>
        </div>
        <div style="padding-bottom: 20px;"></div>

         <div class="form-row">
          <div class="form-group col-md-12">
            <h5><i class="fa fa-link"></i> {{trans('word.ap_link')}} </h5>
            <input type="text" placeholder="https://" name="link" class="form-control">
          </div>
        </div>
<hr>
       <div class="text-right">
         <!-- <button type="submit" class="btn btn-block btn-dark">บันทึก</button> -->

         <button style="width: 100px;" id="applyButton" type="submit" class="btn btn-dark">
         <i id="applyLoad" class="fas fa-circle-notch fa-1x fa-spin"></i>
          {{trans('word.ap_apply')}}
        </button>
       </div>
        
      </form>
        @else<center>
          <hr>
          <h4>{{trans('word.ap_apply_success')}}</h4><br>
          <a href="/{{Config::get('app.locale')}}/application/{{$id_app}}">{{trans('word.ap_view')}}</a>
        </center>
        @endif
    </div>
     @endif
@if($recruit->publish==2)
</div>
@endif
<!-- </div> -->
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $("#recruitTable").DataTable()
  $("#applyLoad").hide()
  
  $("#formApply").submit(()=>{
    $("#applyButton").attr('disabled','disabled');
    $("#applyLoad").show("dd")
    $('#applyButton').attr('style', 'width:150px;');
    $("#applyButton").html("กรุณารอสักครู่")

  })
</script>


@endsection
