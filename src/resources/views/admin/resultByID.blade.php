@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

@php
  use App\Department;
  use App\Recruitment;
@endphp
@if(Auth::user()->type == 2)
  @php
    $check = Department::where('name', $recruit->deptName)->where('user', Auth::user()->id)->count();
    if(!$check){
      header("location: /dept/result");
      exit(0);
    }
  @endphp
@endif

<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">ข้อมูลผู้สมัคร</h2>
    </div>
    <div class="card-body">
      <center style="padding-top: 15px;">
      <h4 style="color: #ec6b26;"><i class="fa fa-file-alt"></i> ข้อมูลผู้สมัคร</h4>
   
      <h5 style="color: #ec6b26;">{{$recruit->facName}} / {{$recruit->department}}</h5>
      <div style="margin-left: 15px; line-height: 1.7rem; color:#000; font-size: 18px;"> {{$recruit->deptName}} :: TCAS {{$recruit->TCAS_ROUND}} :: {{$recruit->name_round}}</div>
      <div style="padding-bottom: 20px;"></div>
    </center>
    <hr>
    @if($applyCount > 0)

@if(Auth::user()->type == 2)

        <h5 class="card-title">
          <text id="interview_confirm_spin"></text>
          <input type="checkbox" id="interview_confirm" style="width: 17px; height: 17px;" type="checkbox" onchange="interview_confirm({{$recruit->id}})" @if($recruit->interview_confirm) checked @else @endif> 
        
        ยืนยัน ประกาศผลผู้มีสิทธิ์สอบคัดเลือก
        </h5>
        
       
@endif

    <div class="text-right" style="padding-bottom: 15px;">
      @if(Auth::user()->type == 2)
      <a href="/api/v2/export/{{$recruit->id}}" target="_blank"><button class="btn btn-sm btn-success"><i class="fa fa-file-excel"></i> Export to Excel</button></a>
      @else
      <a href="/api/export/{{$recruit->id}}" target="_blank"><button class="btn btn-sm btn-success"><i class="fa fa-file-excel"></i> Export to Excel</button></a>
      @endif
    </div>

    <!-- <button class="btn btn-danger"><i class="fa fa-file-pdf"></i> PDF</button> -->
    <div class="alert alert-secondary" id="message">
      APIStatus: <text id="resp"></text>
    </div>
    <div class="table-responsive">
      <table id="dataTable1" class="table table-hover table-bordered table-striped" width="2350px">
        <thead>
          <tr>
            <th colspan="7"><center>ข้อมูล</center></th>
            <th colspan="3"><center>เกรดเฉลี่ย</center></th>
            <th colspan="3"><center>หน่วยกิต<br>ตามกลุ่มสาระการเรียนรู้</center></th>
            <th colspan="5"><center>ข้อมูลอื่น ๆ</center></th>
          </tr>
          <tr>
            <!-- <td>P</td> -->
            @if(Auth::user()->type == 1)
            <td>ส่งข้อมูล</td>
            @endif

            @if(Auth::user()->type == 2)
            <td>ไม่ผ่านการพิจารณา</td>
            @endif

            <td>มีสิทธิ์สอบคัดเลือก</td>
            @if(Auth::user()->type == 1)
            <td>ผ่านการคัดเลือก</td>
            @endif
            <!-- <td>ที่</td> -->
            <td width="200">ชื่อ-นามสกุล</td>
            <td width="100">โทรศัพท์</td>
            <td width="200">วุฒิการศึกษา</td>
            <td align="center">GPAX @if($recruit->GPAX != NULL)<br>({{$recruit->GPAX}}) @endif</td>
            <td align="center">คณิตศาสตร์ @if($recruit->GPA_MTH != NULL) <br>({{$recruit->GPA_MTH}}) @endif</td>
            <td align="center">วิทยาศาสตร์ @if($recruit->GPA_SCI != NULL) <br>({{$recruit->GPA_SCI}}) @endif</td>
            <td align="center">ภาษาอังกฤษ @if($recruit->GPA_ENG != NULL) <br>({{$recruit->GPA_ENG}}) @endif</td>
            <td align="center">คณิตศาสตร์ @if($recruit->CRE_MTH != NULL) <br>({{$recruit->CRE_MTH}}) @endif</td>
            <td align="center">วิทยาศาสตร์ @if($recruit->CRE_SCI != NULL) <br>({{$recruit->CRE_SCI}}) @endif</td>
            <td align="center">ภาษาอังกฤษ @if($recruit->CRE_ENG != NULL) <br>({{$recruit->CRE_ENG}}) @endif</td>
            <td align="center">คะแนนภาษาอังกฤษ@if($recruit->ENG_TEST) <br>( / ) @endif</td>
            <td>Portfolio</td>
            <td>SOP</td>
            <td>ลิงค์เพิ่มเติม</td>
            <td>ปพ.1</td>
          </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($applyData as $app)
            <tr>
            <!-- <td>
              <text id="p{{$app->aid}}"></text>
            </td> -->
            @if(Auth::user()->type == 2)
            <td align="center">
              <input style="width: 17px; height: 17px;" id="en{{$app->aid}}" @if($app->interview) hidden @endif type="checkbox" onchange="end({{$app->aid}})" @if($app->status) checked @else  @endif>
              <text id="e{{$app->aid}}"></text>
              <input type="text" id="end{{$app->aid}}" hidden value="{{$app->status}}">
              <!-- {{$app->aid}} -->
            </td>
            @endif

            @if(Auth::user()->type == 1)
            <td align="center">
              <input style="width: 17px; height: 17px;" @if($app->status) disabled @endif type="checkbox" onchange="sentdept({{$app->aid}})" @if($app->sentdept) checked @else @endif>
              <text id="s{{$app->aid}}"></text>
              <!-- {{$app->aid}} -->
            </td>
            @endif

            <td align="center">
              <input style="width: 17px; height: 17px;" id="interview{{$app->aid}}" @if($app->status == 1) hidden="hidden" @endif type="checkbox" onchange="interview({{$app->aid}})" @if($app->interview) checked @else @endif>
              <text id="i{{$app->aid}}"></text>
              <input type="text" id="itv{{$app->aid}}" hidden value="{{$app->interview}}">
              <font color="red">@if($app->sentdept && $app->status && !$app->interview && !$app->result) ไม่รับ @endif</font>
              <!-- {{$app->aid}} -->
            </td>

            @if(Auth::user()->type == 1)
            <td align="center">
              <input style="width: 17px; height: 17px;" id="result{{$app->aid}}" @if($app->status == 1) hidden="hidden" @endif type="checkbox" onchange="result({{$app->aid}})" @if($app->result) checked @else @endif>
              <text id="p{{$app->aid}}"></text>
              <!-- {{$app->aid}} -->
              <font color="red">@if($app->sentdept && $app->status && !$app->interview && !$app->result) ไม่รับ @endif</font>
            </td>
            @endif
            @php 
            $path = "";
            if(Auth::user()->type == 1){
              $path = "admin";
            }else{
              $path = "dept";
            }
            @endphp
           
            <!-- <td>{{$i++}}</td> -->
            <td><a href="/{{$path}}/app/{{$app->aid}}">{{$app->firstname." ".$app->lastname}}</a></td>
            <td>{{$app->telephone}}</td>
            <td>{{$app->edu_type}}</td>
            <td align="center">@if($app->GPAX >= $recruit->GPAX) <font color="green">{{$app->GPAX}}</font> @else <font color="red">{{$app->GPAX}}</font>@endif</td>
            <td align="center">@if($app->GPA_MTH >= $recruit->GPA_MTH) <font color="green">{{$app->GPA_MTH}}</font> @else <font color="red">{{$app->GPA_MTH}}</font> @endif</td>
            <td align="center">@if($app->GPA_SCI >= $recruit->GPA_SCI) <font color="green">{{$app->GPA_SCI}}</font> @else <font color="red">{{$app->GPA_SCI}}</font> @endif</td>
            <td align="center">@if($app->GPA_ENG >= $recruit->GPA_ENG)<font color="green">{{$app->GPA_ENG}}</font> @else <font color="red">{{$app->GPA_ENG}}</font>  @endif</td>
            <td align="center">@if($app->CRE_MTH >= $recruit->CRE_MTH)<font color="green">{{$app->CRE_MTH}}</font> @else <font color="red">{{$app->GPA_MTH}}</font>  @endif</td>
            <td align="center">@if($app->CRE_SCI >= $recruit->CRE_SCI)<font color="green">{{$app->CRE_SCI}}</font> @else <font color="red">{{$app->CRE_SCI}}</font>  @endif</td>
            <td align="center">@if($app->CRE_ENG >= $recruit->CRE_ENG)<font color="green">{{$app->CRE_ENG}}</font> @else <font color="red">{{$app->CRE_ENG}}</font> @endif</td>
            <td><small>
              @if($recruit->ENG_TEST) 
                @if($app->IELTS != NULL || $app->TOEFL != NULL || $app->TOEIC != NULL || $app->CUTEP != NULL)
                   IELTS: {{$app->IELTS}}<br>TOEFL: {{$app->TOEFL}}<br>TOEIC: {{$app->TOEIC}}<br>CU-TEP: {{$app->CUTEP}}<br>RMIT: {{$app->RMIT}}
                @else
                    ไม่มี
                @endif
              @else - @endif
              
            </small></td>
            <td align="center">
              <a href="{{env('BASE_PORT_STORAGE')}}/{{$app->portfolio}}" target="_blank">
                <button class="btn btn-sm btn-primary"><i class="fa fa-file-pdf"></i></button>
              </a>
            </td>
            <td align="center">
              @if($app->sop == NULL)
              -
              @else
              <a href="{{env('BASE_SOP_STORAGE')}}/{{$app->sop}}" target="_blank">
                <button class="btn btn-sm btn-secondary"><i class="fa fa-file-pdf"></i></button>
              </a>
              @endif
              
            </td>

            <td align="center">
              @if($app->sop == NULL)
              -
              @else
              <a href="{{$app->link}}" target="_blank">
                <button class="btn btn-sm btn-warning"><i class="fa fa-external-link-alt"></i></button>
              </a>
              @endif
              
            </td>

            <td align="center">
              <a href="{{env('BASE_FILE_STORAGE')}}/{{$app->transcript}}" target="_blank">
                <button class="btn btn-sm btn-success"><i class="fa fa-file-pdf"></i></button>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
    <center>
      <h5>ไม่มีข้อมูลผู้สมัคร</h5>
    </center>
    @endif
     </div>
@csrf
<!-- </div> -->
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  @if(Auth::user()->type == 1)
<script type="text/javascript">
  $("#dataTable1").DataTable({
    "pageLength": 100,
  })

  $("#message").hide()

  function result(id){
    $("#p"+id).html("<font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    $("#message").show("dd")
    $("#resp").html("Result ["+id+"] waiting <font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    var _token = $('input[name="_token"]').val()
    $.ajax({
      url : '/api/result-update',
      type: 'POST',
      data: {
        _token:_token,
        id:id
      },
      success: function(resp){
        if(resp.status == 200){
          $("#resp").html("<font color='green'><i class='fa fa-check'></i></font> Result ["+id+"] OK!")
          $("#p"+id).html("")
        }
      }
    })
  }


  function sentdept(id){
    $("#s"+id).html("<font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    $("#message").show("dd")
    $("#resp").html("Sent to Department ["+id+"] waiting <font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    var _token = $('input[name="_token"]').val()
    $.ajax({
      url : '/api/sentdept-update',
      type: 'POST',
      data: {
        _token:_token,
        id:id
      },
      success: function(resp){
        if(resp.status == 200){
          $("#resp").html("<font color='green'><i class='fa fa-check'></i></font> Send to Department ["+id+"] OK!")
          $("#s"+id).html("")
        }
      }
    })
  }

function interview(id){
    $("#i"+id).html("<font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    $("#message").show("dd")
    $("#resp").html("Interview Update ["+id+"] waiting <font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    var _token = $('input[name="_token"]').val()
    $.ajax({
      url : '/api/interview-update',
      type: 'POST',
      data: {
        _token:_token,
        id:id
      },
      success: function(resp){
        if(resp.status == 200){
          $("#resp").html("<font color='green'><i class='fa fa-check'></i></font> Interview Update ["+id+"] OK!")
          $("#i"+id).html("")
        }
      }
    })
  }
</script>
@endif

@if(Auth::user()->type == 2)

<script type="text/javascript">
  $("#dataTable1").DataTable({
    "pageLength": 100
  })

  $("#message").hide()

function interview_confirm(id){
  $("#interview_confirm_spin").html("<font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    $("#message").show("dd")
    $("#resp").html("waiting <font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    var _token = $('input[name="_token"]').val()
    $.ajax({
      url : '/api/v2/interview-confirm',
      type: 'POST',
      data: {
        _token:_token,
        id:id,
      },
      success: function(resp){
        if(resp.status == 200){
          $("#resp").html("<font color='green'><i class='fa fa-check'></i></font> บันทึกข้อมูลสำเร็จ")
          $("#interview_confirm_spin").html("")
        }
      }
    })
}

function end(id){
    $("#e"+id).html("<font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    $("#message").show("dd")
    $("#resp").html("End ["+id+"] waiting <font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    var _token = $('input[name="_token"]').val()
    $.ajax({
      url : '/api/v2/end-update',
      type: 'POST',
      data: {
        _token:_token,
        id:id
      },
      success: function(resp){

        if($("#end"+id).val() == "1"){
          $("#result"+id).show("dd")
          $("#interview"+id).show("dd")
          $("#interview"+id).removeAttr('hidden')
          $("#result"+id).removeAttr('hidden')
          $("#end"+id).val(0)
        }else if($("#end"+id).val() == "0"){
          $("#result"+id).hide("dd")
          $("#interview"+id).hide("dd")
          $("#end"+id).val(1)
        }

        if(resp.status == 200){
          $("#resp").html("<font color='green'><i class='fa fa-check'></i></font> End ["+id+"] OK!")
          $("#e"+id).html("")
        }
      }
    })
  }

  function result(id){
    $("#p"+id).html("<font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    $("#message").show("dd")
    $("#resp").html("Result ["+id+"] waiting <font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    var _token = $('input[name="_token"]').val()
    $.ajax({
      url : '/api/v2/result-update',
      type: 'POST',
      data: {
        _token:_token,
        id:id
      },
      success: function(resp){
        if(resp.status == 200){
          $("#resp").html("<font color='green'><i class='fa fa-check'></i></font> Result ["+id+"] OK!")
          $("#p"+id).html("")
        }
      }
    })
  }

function interview(id){
    $("#i"+id).html("<font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    $("#message").show("dd")
    $("#resp").html("Interview Update ["+id+"] waiting <font color='#999'> <i class='fas fa-spinner fa-spin'></i></font>")
    var _token = $('input[name="_token"]').val()
    $.ajax({
      url : '/api/v2/interview-update',
      type: 'POST',
      data: {
        _token:_token,
        id:id
      },
      success: function(resp){
        if($("#itv"+id).val() == 0){
          $("#en"+id).hide('dd')
          $("#itv"+id).val(1)
        }else{
          $("#en"+id).show('dd')
          $("#en"+id).removeAttr('hidden')
          $("#itv"+id).val(0)
        }

        if(resp.status == 200){
          $("#resp").html("<font color='green'><i class='fa fa-check'></i></font> Interview Update ["+id+"] OK!")
          $("#i"+id).html("")
        }
      }
    })
  }
</script>

@endif

@endsection
