@extends('layouts.app')
@section('title', 'ยื่นสมัครตามสาขา')

@section('content')
<style type="text/css">
  .table th, .table td {
    padding: 0.75rem;
     vertical-align: middle; 
}
</style>
<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">{{trans("word.s_app_status")}}</h2>
    </div>
    <div class="card-body">
      <!-- <h5 style="color: #ec6b26;">ใบสมัครของฉัน</h5> -->
    @if($count == 0)
      <div class="alert alert-warning">{{trans("word.s_no_app")}}</div>
      @else
         <h5 style="color: #ec6b26;">{{trans('word.s_personal_data')}}</h5>
        <div style="margin-left: 30px; padding-bottom: 20px; line-height: 1.7rem; font-size: 18px;">
           <b style="color:#000;">{{trans('word.s_name')}} :</b> {{$profile->prefix.$profile->firstname." ".$profile->lastname}}<br>
           <b style="color:#000;">{{trans('word.s_idcard')}} :</b> {{$profile->citizen_id}}
        </div>
      <div class="table-responsive">
        <table class="table table-bordered" style="color:#000;">
          <!-- <tr>
            <td colspan="3" align="center">เลือกใบสมัคร</td>
          </tr> -->
          <tr bgcolor="#ec6b26" style="color: #fff;">
            <td align="center">{{trans('word.s_id_app')}}</td>
            <td colspan="1" align="center">{{trans('word.s_detail')}}</td>
            <td align="center">{{trans('word.s_status')}}</td>
          </tr>
          @if($count == 0)
            <tr>
              <td align="center" colspan="2">{{trans('word.s_no_app')}}</td>
            </tr>
          @endif
          @foreach($application as $app)
            <tr style="@if($app->published==2) background-color: #f5f5f5; color: #708090; @endif">
              <td align="center" valign="middle">6420210{{$app->id}}</td>
              <td style="line-height: 20px; vertical-align: middle;">
                {{$app->tcas}} {{$app->nameround}}<br>
                @if(Config::get('app.locale') == 'th'){{$app->faculty}} @else {{$app->f_name_en}} @endif
                @if(Config::get('app.locale') == 'th') | {{$app->department}} @endif<br>
                @if(Config::get('app.locale') == 'th') สาขา : {{$app->branch}} @else Department : {{$app->d_name_en}} @endif<br>
                <small>[ {{$app->created_at}} ]</small>
              </td>
              <td style="line-height: 20px;">
              @if($app->published == 2)
              <center>
              <p>
                <!-- <i class="fa fa-stop-circle"></i> ปิดรับสมัคร -->
                <!-- <br> -->
                <a href="/{{$lang}}/application/{{$app->id}}"><i class="fa fa-poll-h"></i> {{trans('word.s_result')}}</a>
              </p>
            </center>
              @else
              <center>
              <a href="/{{$lang}}/application/{{$app->id}}"><i class="fa fa-search"></i> {{trans('word.s_status')}}</a>
              </center>
              <div style="padding-bottom: 16px;"></div>
              @endif

              @if($app->published == 1 && $app->state == 0 && $app->sentdept == 0)
              <center>
              <a style="color:red;" onclick='deleteApplication({{$app->id}});' href="#"> <i class="fa fa-times"></i> {{trans('word.s_cancel')}} </a>
            </center>
              @else
              <!-- <button class="card-link btn btn-sm btn-dark">ติดตามสถานะ</button> -->
              @endif
              </td>
            </tr>
          @endforeach

        </table>
      </div>
      @endif
      <!-- <hr> -->
    <!--   <div class="jumbotron" style="line-height: 25px; text-align: center;">
        ติดต่อสอบถามข้อมูลเพิ่มเติมได้ที่ <br><br>

        สำนักงานคัดเลือกและสรรหานักศึกษา (Admissions and Recruitment Office)<br>
        126 ถนนประชาอุทิศ แขวงบางมด เขตทุ่งครุ กรุงเทพมหานคร 10140<br>
        โทรศัพท์ : 02-470-8333 โทรสาร : 02-470-8367<br>
        หรืออีเมล์ : admission@kmutt.ac.th
      </div> -->



<!--       @if($count == 0)
        <h5>ไม่มีข้อมูลการสมัคร</h5>
      @endif
      <div class="row">
        @foreach($application as $app)
          <div class="col-md-3" style="padding: 20px;" >
          <div class="card" style="@if($app->published==2) background-color: #DCDCDC; @endif">
            <div class="card-body">
              <h5 class="card-title" style="@if($app->published==2) color: #999; @else color: #ec6b26; @endif">#APPID00{{$app->id}}</h5>
              <h6 class="card-subtitle mb-2 text-muted"><b>{{$app->faculty}}</b></h6>
              <p class="card-text mb-2" style="line-height: 1.3rem;">
                {{$app->department}} <br> 
                สาขา : {{$app->branch}}<br>
                 <small>[ {{$app->created_at}} ]</small>

              </p>
            
              <div class="text-right">
              @if($app->published == 2)
              <h5><i class="fa fa-stop-circle"></i> ปิดรับสมัคร</h5>
              @else
              <a href="/{{$lang}}/application/{{$app->id}}" class="card-link btn btn-sm btn-primary">สถานะ</a>
              @endif

              @if($app->published == 1 && $app->state == 0 && $app->sentdept == 0)
              <button onclick='deleteApplication({{$app->id}});'  class="card-link btn btn-sm btn-danger"><i class="fa fa-times"></i> ยกเลิกใบสมัคร</button>
              @else
             
              @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div> -->
<!-- </div> -->
</div>
@csrf
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $("#recruitTable").DataTable()
</script>

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
