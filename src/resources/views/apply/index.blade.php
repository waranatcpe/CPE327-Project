@extends('layouts.app')
@section('title', 'ยื่นสมัครตามสาขา')

@section('content')

<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">{{trans('word.a_title')}}</h2>
    </div>
    <div class="card-body">
      @if($status['profile'] && $status['education'] && $status['transcript'])

       
       <form method="post" action="">
        @csrf

        <div class="form-row">
          <div class="col-md-4"></div>
           <div class="form-group col-md-4">
            <h5 style="color: #ec6b26;">{{trans('word.a_search')}}</h5>
            <label>@if(Config::get('app.locale') == "th") ระดับการศึกษา @else Degree @endif</label>
            <input type="text" value="@if(Config::get('app.locale') == 'th') ปริญญาตรี @else Bachelor Degree @endif" disabled class="form-control">
            <label style=" padding-top: 15px;">{{trans('word.a_faculty')}}</label>
            <select id="faculty" name='faculty' class="form-control">
              <option value="0">{{trans('word.a_choose')}}</option>
              @foreach($faculty as $fac)
                <option value="{{$fac->id}}">@if(Config::get('app.locale') == "th") {{$fac->name}} @else {{$fac->name_en}} @endif</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4"></div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label >{{trans('word.a_dept')}}</label>
            <select id="department" name="department" class="form-control">
              <div id='target'></div>
            </select>
          </div>
          <div class="col-md-4"></div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4 text-right">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> {{trans('word.a_search_btn')}}</button>
          </div>
          <div class="col-md-4"></div>
         </div>
       </form>
       
      <!-- <div class="table-responsive">
                <table id="recruitTable" class="table table-hover">
                  <thead>
                    <tr style="color: #ec6b26 !important">
                        <th>{{trans('word.a_recruit_id')}}</th>
                        <th>{{trans('word.a_faculty')}}</th>
                        <th>{{trans('word.a_dept')}}</th>
                        <th>{{trans('word.a_close')}}</th>
                        <th>{{trans('word.a_apply')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($recruitData as $data)
                    <tr>
                      
                        <td>#AR{{env('APP_YEAR')}}00{{$data->id}}</td>
                        <td>{{$data->facName}}</td>
                        <td>{{$data->deptName}}</td>
                        <td>{{$data->closeDate}}</td>

                        <td>
                          <a href="/{{Config::get('app.locale')}}/apply/{{$data->id}}">
                            <button class="btn btn-sm btn-dark btn-block">{{trans('word.a_apply')}}</button>
                          </a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>    
                </div> -->
 
                @else
                <div class="container text-center" style="padding-top: 50px;">
                <font style="font-size: 7rem;"><i class="fa fa-exclamation-circle"></i> </font>
                  <h4><br>{{trans('word.a_alert')}}</h4>
                  <br>
                  <a href="/home"><u>{{trans('word.a_myprofile')}}</u></a>
                  </div>
                @endif
    </div>
<!-- </div> -->
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
  $("#faculty").change(()=>{
    var _token = $('input[name="_token"]').val()
    var id = $("#faculty").val()
    $.ajax({
      url: '/userapi/department',
      method:"POST",
      data:{faculty_id:id, _token:_token},
      success:function(resp){
        $("#department").html("")
        var teks = "<option>@if(Config::get('app.locale') == 'th') โปรดเลือกสาขา @else Choose department @endif</option>"
        var i
        for(i=0;i<resp.length;i++){
          if(resp[i]['department'] == null){
            teks += "<option value='"+resp[i]['id']+"'>" +
            resp[i]['<?php if(Config::get("app.locale") == "th"){echo "name";}else{echo"name_en";}?>']+
            "</option>"
          }else{
            // teks += "<option value='"+resp[i]['id']+"'>" + resp[i]['department'] + " | "+
            // resp[i]['name']+
            // "</option>"
            teks += "<option value='"+resp[i]['id']+"'>" +
            resp[i]['<?php if(Config::get("app.locale") == "th"){echo "name";}else{echo"name_en";}?>']+
            "</option>"
          }
        }
        $("#department").append(teks)
      }
    })
  })
</script>

@endsection
