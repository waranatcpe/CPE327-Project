@extends('layouts.app')
@section('title', 'ยื่นสมัครตามสาขา')

@section('content')
<?php $error = 0;?>
<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">{{trans('word.s_app_info')}} </h2>
    </div>
    <div class="card-body">
    <center style="padding-top: 15px; padding-bottom: 20px;">
      <h4 style="color: #ec6b26;"><i class="fa fa-file-alt"></i> Active Recruitment</h4>
   
      <h5 style="color: #ec6b26;">@if(Config::get('app.locale') == 'th') {{$recruit->facName}} / {{$recruit->department}} @else {{$recruit->f_name_en}} @endif</h5>
      <div style="margin-left: 0px; line-height: 1.7rem; color:#000; font-size: 18px;"> @if(Config::get('app.locale') == 'th'){{$recruit->deptName}}@else {{$recruit->d_name_en}} @endif :: {{$recruit->TCAS_ROUND}} :: {{$recruit->name_round}}</div>
      <div style="padding-bottom: 20px;"></div>
    </center>

    <div class="row">
      <div class="col-md-3">
      <h5 style="color: #ec6b26;">{{trans('word.s_personal_data')}}</h5>
        <div style="margin-left: 30px; line-height: 1.7rem; font-size: 18px;">
            <b style="color:#000;">{{trans('word.s_name')}}</b> : {{$profile->firstname." ".$profile->lastname}}<br>
            <b style="color:#000;">{{trans('word.s_idcard')}}</b> : {{$profile->citizen_id}}<br>
            <b style="color:#000;">{{trans('word.s_school')}}</b> : {{$profile->school." จ.".$profile->province}}<br>            
        </div><div style="padding-bottom: 15px;"></div>
      </div>

      <div class="col-md-3">
        <h5 style="color: #ec6b26;">{{trans('word.s_doc')}}</h5>
          <div style="margin-left: 20px; line-height: 1.5rem; font-size: 18px;">
          <a href="{{env('BASE_FILE_STORAGE')}}/{{$profile->transcript}}" target="_blank">
             1. {{trans('word.s_trans')}}
          </a><br>
          <a href="{{env('BASE_PORT_STORAGE')}}/{{$app->portfolio}}" target="_blank">
             2. {{trans('word.s_port')}}
          </a><br>
          @if($app->sop != null)
          <a href="{{env('BASE_SOP_STORAGE')}}/{{$app->sop}}" target="_blank">
             3. Statement of Purpose
          </a>
          @endif
          
          @if($app->alumni != null)
          <br>
            <a href="{{env('BASE_ALUMNI_STORAGE')}}/{{$app->alumni}}" target="_blank">
            @if($app->sop != null) 4. @else 3. @endif
            {{trans('word.s_alumni')}}
          </a>
          @endif
          </div>
      </div>
    </div>
        <h5 style="color: #ec6b26;">{{trans('word.s_rule')}}</h5>
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
                    <b style="color:#000;">{{trans('word.s_gpa_mth')}}</b> : 
                    @if($recruit->GPA_MTH == 0) - @else {{number_format($recruit->GPA_MTH,2)}}  @endif<br>

                    @if($profile->GPA_SCI < $recruit->GPA_SCI)<?php $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif 
                    <b style="color:#000;">{{trans('word.s_gpa_sci')}}</b> : 
                    @if($recruit->GPA_SCI == 0) - @else {{number_format($recruit->GPA_SCI,2)}}  @endif<br>

                    @if($profile->GPA_ENG < $recruit->GPA_ENG)<?php  $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif 
                    <b style="color:#000;">{{trans('word.s_gpa_eng')}}</b> : 
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
                    <b style="color:#000;">{{trans('word.s_cre_mth')}}</b> : 
                    @if($recruit->CRE_MTH == 0) - @else {{number_format($recruit->CRE_MTH,2)}}  @endif<br>

                    @if($profile->CRE_SCI < $recruit->CRE_SCI)<?php  $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif
                    <b style="color:#000;">{{trans('word.s_cre_sci')}}</b> : 
                     @if($recruit->CRE_SCI == 0) - @else {{number_format($recruit->CRE_SCI,2)}}  @endif<br>

                     @if($profile->CRE_ENG < $recruit->CRE_ENG)<?php  $error++;?>
                    <font color="red"><b><i class="fa fa-times"></i></b></font> @else <font color="green"><i class="fa fa-check"></i></font>  @endif
                    <b style="color:#000;">{{trans('word.s_cre_eng')}}</b> : 
                     @if($recruit->CRE_ENG == 0) - @else {{number_format($recruit->CRE_ENG,2)}}  @endif<br>

                    @if($recruit->ENG_TEST) 
                      @if($profile->IELTS != NULL || $profile->TOEFL != NULL || $profile->TOEIC != NULL || $profile->CUTEP != NULL)
                        <font color="green"><i class="fa fa-check"></i></font>
                      @else
                      <?php  $error++;?>
                        <font color="red"><b><i class="fa fa-times"></i></b></font>
                      @endif
                    @else <font color="green"><i class="fa fa-check"></i></font>  @endif
                    <b style="color:#000;">{{trans('word.s_eng_test')}}</b> : 
                    @if($recruit->ENG_TEST) 
                      {{trans('word.s_req')}} 
                    @else 
                      {{trans('word.s_not_req')}} 
                    @endif
                </div>
              </div>
        </div>
        <!-- @if($error > 0)
        <div class="row" style="padding-top: 15px;">
          <div class="col-md-3">
            <div class="alert alert-warning">
          <b style="color:#000;"><i class="fa fa-exclamation-circle"></i> คุณไม่ผ่านเกณฑ์คัดเลือก {{$error}} เกณฑ์</b>
        </div>
          </div>
        </div>
        @else
          <div class="row" style="padding-top: 15px;">
          <div class="col-md-3">
            <div class="alert alert-success">
          <b style="color:#000;"><i class="fa fa-thumbs-up"></i> คุณผ่านเกณฑ์ทั้งหมด</b>
        </div>
          </div>
        </div>
        @endif
        <hr>

          <h5 style="color: #ec6b26;">เอกสารประกอบการสมัคร</h5>
          <div style="margin-left: 20px; line-height: 1.5rem; font-size: 18px;">
          <a href="{{env('BASE_FILE_STORAGE')}}/{{$profile->transcript}}" target="_blank">
             1. ผลการเรียน
          </a><br>
          <a href="{{env('BASE_PORT_STORAGE')}}/{{$app->portfolio}}" target="_blank">
             2. แฟ้มสะสมผลงาน
          </a><br>
          @if($app->sop != null)
          <a href="{{env('BASE_SOP_STORAGE')}}/{{$app->sop}}" target="_blank">
             3. Statement of Purpose
          </a>
          @endif
          </div>
 -->
          <!-- <br> -->
     
        <!--  <div class="alert alert-info" style="line-height: 1.5rem;">
           <b>แฟ้มสะสมผลงาน</b> : อัพโหลดด้วยไฟล์ *.pdf  ขนาดไม่เกิน 20MB เท่านั้น และเนื้อหาในแฟ้มสะสมผลงาน ควรตรงกับสาขาวิชาที่จะสมัคร<br>
           <b>Link เอกสารอื่น ๆ </b> : แนะนำให้ใช้ Google Drive / One Drive / Youtube และเปิดการเข้าถึงแบบสาธารณะ
         </div> -->
         <!-- <h5><i class="fa fa-upload"></i> แฟ้มสะสมผลงาน/ผลกาเรียน</h5> -->
         
        <!-- <div class="form-row">
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
        </div> -->
        
         <!-- <div class="form-row">
          <div class="form-group col-md-4">
            <h5 style="color: #ec6b26;"> เอกสารแนบเพิ่มเติม </h5>
            <div style="margin-left: 20px;">
            @if($app->link != "")
            <a href="{{$app->link}}" target="_blank">{{$app->link}}</a>
            @else ไม่มี @endif 
            </div>
          </div>
        </div> -->

        <!-- <hr> -->
        @if($app->published == 1 && $app->state == 0 && $app->sentdept == 0)

          <div class="col-md-12" style=" background-color: #fff; padding: 20px;">
              <h5 style="color: #fff; background-color: #ec6b26; width: 250px; height: auto; padding: 10px 0px 10px 20px; border-radius: 10px;"><i class="fa fa-bars"></i> {{trans('word.s_status')}}</h5>
              <div style="padding-bottom: 30px;"></div>
              <div class="row">
                <div class="col-md-2">
                  <center>
                    <font color="#ec6b26">
                      <i class="fa fa-4x fa-file-upload"></i>
                    </font><br>
                      <p style="padding-top: 10px;">{{trans('word.s_apply')}}</p>
                  </center>
                </div>
                <div class="col-md-1">
                  <br>
                  <center><i class="fa fa-chevron-right"></i></center>
                  <br>
                </div>
                <div class="col-md-2">
                  <center>
                    <font color="@if($app->sentdept==1) #ec6b26 @else gray @endif">
                      <i class="fa fa-4x fa-spinner"></i>
                    </font><br>
                      <p style="padding-top: 10px;">{{trans('word.s_wait')}}</p>
                  </center>
                </div>
              </div>
              <hr>
              <div class="text-right">
                <button onclick="deleteApplication({{$app->id}})" class="btn  btn-danger"><i class="fa fa-times"></i> {{trans('word.s_cancel')}}</button>
              </div>
            </div>
        @else
          
            <div class="col-md-12" style=" background-color: #fff; padding-top: 20px;">
              <h5 style="color: #fff; background-color: #ec6b26; width: 250px; height: auto; padding: 10px 0px 10px 20px; border-radius: 10px;"><i class="fa fa-bars"></i> {{trans('word.s_status')}}</h5>

              <div style="padding-bottom: 30px;"></div>
              <div class="row">
                <div class="col-md-2">
                  <center>
                    <font color="#ec6b26">
                      <i class="fa fa-4x fa-file-upload"></i>
                    </font><br>
                      <p style="padding-top: 10px;">{{trans('word.s_apply')}}</p>
                  </center>
                </div>

                <div class="col-md-1">
                  <br>
                  <center><i class="fa fa-chevron-right"></i></center>
                  <br>
                </div>

                <div class="col-md-2">
                  <center>
                    <font color="@if($app->sentdept==1) #ec6b26 @else gray @endif">
                      <i class="fa fa-4x fa-search"></i>
                    </font><br>
                      <p style="padding-top: 10px;">{{trans('word.s_process')}}</p>
                  </center>
                </div>

                <div class="col-md-1">
                  <br>
                  <center><i class="fa fa-chevron-right"></i></center>
                  <br>
                </div>
              
                @if($app->interview == 1)
                  @if($recruit->interview_confirm == 1)
                  <div class="col-md-2">
                    <center>
                      <font color="@if($app->interview == 1) #ec6b26 @else gray @endif">
                        <i class="fa fa-4x fa-walking"></i>
                      </font><br>
                        <p style="padding-top: 10px;">{{trans('word.s_quiz')}}</p>
                    </center>
                  </div>
                  @else
                  <div class="col-md-2">
                    <center>
                      <font color="@if($app->state == 1 && $recruit->interview_confirm == 1) #ec6b26 @else gray @endif">
                        <i class="fa fa-4x fa-scroll"></i>
                      </font><br>
                        <p style="padding-top: 10px;">@if($app->state==1 && $recruit->interview_confirm == 1) @if(Config::get('app.locale') == 'th') ประกาศผลแล้ว @else announced @endif @else @if(Config::get('app.locale') == 'th') รอประกาศผล @else Wait for the result @endif @endif</p>
                    </center>
                  </div>
                  @endif
                @else
                <div class="col-md-2">
                  <center>
                    <font color="@if($app->state == 1 && $recruit->interview_confirm == 1) #ec6b26 @else gray @endif">
                      <i class="fa fa-4x fa-scroll"></i>
                    </font><br>
                      <p style="padding-top: 10px;">@if($app->state==1 && $recruit->interview_confirm == 1) @if(Config::get('app.locale') == 'th') ประกาศผลแล้ว @else announced @endif @else @if(Config::get('app.locale') == 'th') รอประกาศผล @else Wait for the result @endif @endif</p>
                  </center>
                </div>
                @endif
              
                

                <div class="col-md-1">
                  <br>
                  <center><i class="fa fa-chevron-right"></i></center>
                  <br>
                </div>

                <div class="col-md-2">
                  <center>
                    <font color="@if($app->state == 1 && $recruit->interview_confirm == 1) #ec6b26 @else gray @endif">
                      <i class="fa fa-4x fa-stop-circle"></i>
                    </font><br>
                      <p style="padding-top: 10px;">{{trans('word.s_closed')}}</p>
                  </center>
                </div>
              </div>

              <!-- <div class="alert alert-warning">อยู่ในขั้นตอนการตรวจใบสมัครไม่สามารถยกเลิกได้</div> -->
              <br>
              <!-- <h4 style="color: #ec6b26; padding-top: 20px; padding-left:15px; ">ประกาศ</h4><hr> -->
              <h5 style="color: #fff; background-color: #ec6b26; width: 250px; height: auto; padding: 10px 0px 10px 20px; border-radius: 10px;"><i class="fa fa-bullhorn"></i> {{trans('word.s_announce')}}</h5>
              <hr>
              
              @if($app->interview == 1 && $recruit->interview_confirm == 1 && $app->status == 0)
              <div class="alert alert-info">
                <center>
                <b style="color: #ec6b26; font-size: 18px;">Update! :: </b>
                  <text class=""><h4 style="padding-top: 10px;">@if(Config::get("app.locale") == 'th') คุณมีสิทธิ์สอบคัดเลือก @else Qualifed @endif</h4></text>
                </div>
                </center> 
                <div style="border-style: double; padding: 20px; border-color: #999999;">
                  <h4><u>{{trans('word.itv_detail')}}</u></h4>
                  <div style="line-height: 1.3rem;">
                    @if($app->itv_location == NULL || $app->interview_at == NULL)
                      {{trans("word.no_itv")}}
                    @else
                      @if(Config::get('app.locale') == 'th')
                        <font color="#000">สถานที่สอบคัดเลือก : {{$app->interview_at}}<br>
                        วัน/เวลาสอบคัดเลือก : {{$app->interview_time}}</font><br>
                      @else
                        <font color="#000">Examination location : {{$app->interview_at}}<br>
                        Examination Date/Time : {{$app->interview_time}}</font><br>
                      @endif
                      @php echo "<hr>".$app->itv_location @endphp
                    @endif
                  </div>
                </div>
              @endif

              @if($app->result == 1 && $app->status == 1)                
                <div class="alert alert-success"><center>
                <b style="color: #ec6b26; font-size: 18px;">{{trans('word.announced')}}! :: </b>
                  <text class=""><h4 style="padding-top: 10px;">{{trans('word.v_pass')}}</h4></text>
                </div>
              </center>
                <hr>
              @elseif($app->result == 0 && $app->state == 1 && $recruit->interview_confirm == 1)
              <div class="alert alert-danger"><center>
                <b style="color: #ec6b26; font-size: 18px;">{{trans('word.announced')}}! :: </b>
                  <text class=""><h4 style="padding-top: 10px;">{{trans('word.v_nopass')}}</h4></text>
                  </center>
                </div>
                <hr>
              @endif
              </center>
              <br>
              <!-- <p style="line-height: 2rem;padding: 0px 20px 20px 20px; color: black; font-size: 20px"> -->
                <div style="border-style: double; padding: 20px; border-color: #999999;">
                  <h4><u>{{trans('word.ann_admission')}}</u></h4>
                @php echo $app->announcement; @endphp
                @if($app->announcement == "") {{trans('word.no_ann_adm')}}  @endif
              </div>
              <!-- </p> -->
            </div>
            <!-- <span class="alert alert-danger"></span></center> -->
        @endif
    </div>
<!-- </div> -->
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

<script type="text/javascript">
  function deleteApplication(id){
    swal({
   title: "@if(Config::get('app.locale') == 'th')  ต้องการลบใบสมัคร หรือไม่ ? @else Are you sure ? @endif",
   text: "@if(Config::get('app.locale') == 'en') You cannot undo this action. @endif",
   icon: "warning",
   buttons: true,
   dangerMode: true,
 }).then((resp) => {
    if (resp) {
      var _token = $('input[name="_token"]').val()
      $.ajax({
        url:'/userapi/cancel/app/'+id,
        type:'delete',
        data:{_token:_token},
        success:function(resp){
          if(resp.status == 200){
            swal("","@if(Config::get('app.locale') == 'th') ยกเลิกใบสมัครเรียบร้อยแล้ว @else Your application has been deleted. @endif",'success').then(()=>{
              window.location = '/{{Config::get("app.locale")}}/application'
            })
          }
        }
      })
    }
  })
  }

</script>

@endsection
