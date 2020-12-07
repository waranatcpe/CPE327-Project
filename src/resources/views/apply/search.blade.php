@extends('layouts.app')
@section('title', 'ยื่นสมัครตามสาขา')

@section('content')
<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">{{trans('word.a_title')}}</h2>
    </div>
    <div class="card-body">
      @if($status['profile'] && $status['education'] && $status['transcript'])

<!--        <form method="post" action="">
        @csrf
        <div class="form-row">
          <div class="col-md-4"></div>
           <div class="form-group col-md-4">
            <h5 style="color: #ec6b26;">{{trans('word.a_search')}}</h5>
            <label>{{trans('word.a_faculty')}}</label>
            <select id="faculty" name='faculty' class="form-control">
              <option value="0">{{trans('word.a_choose')}}</option>
              @foreach($faculty as $fac)
                <option value="{{$fac->id}}">{{$fac->name}}</option>
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

        -->
       <!-- <hr> -->
  <h5><font color="#ec6b26"><i class="fa fa-search"></i> {{trans('word.a_result')}}</font> '{{$result}}'</h5><br>
  @if($count > 0)
      <div class="table-responsive">
                <table class="table table-hover" style="">
                  <thead>
                    <tr style="color: #ec6b26 !important">
                        <!-- <td>ที่</td> -->
                        <!-- <th>TCAS</th> -->
                        <th>{{trans('word.a_recruit_id')}}</th>
                        <th>@if(Config::get('app.locale') == "th") ชื่อรอบ @else Round @endif </th>
                        <th>{{trans('word.a_faculty')}}</th>
                        <!-- <th>ภาควิชา</th> -->
                        <th>{{trans('word.a_dept')}}</th>
                        <th>{{trans('word.a_close')}}</th>
                        <!-- <th>สถานะ</th> -->
                        <th >{{trans('word.a_apply')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($recruitData as $data)
                  <tr onclick="window.location='/{{Config::get("app.locale")}}/apply/{{$data->id}}'">
                        <!-- <td></td> -->
                        <!-- <td>{{$data->TCAS_ROUND}}</td> -->
                        <td>#AR{{env('APP_YEAR')}}00{{$data->id}}</td>
                        <td>{{$data->name_round}}</td>
                        <td>@if(Config::get('app.locale') == "th"){{$data->facName}} @else {{$data->f_name_en}}@endif</td>
                        <!-- <td>{{$data->department}}</td> -->
                        <td>@if(Config::get('app.locale') == "th"){{$data->deptName}} @else {{$data->d_name_en}}@endif</td>
                        <td>{{$data->closeDate}}</td>
                        <!-- <td>
                          @if($data->publish)
                            <font color="green">Published</font>
                          @else
                            <font color="red">Close</font>
                          @endif
                        </td> -->
                        <td>
                          <a href="/{{Config::get('app.locale')}}/apply/{{$data->id}}">
                            {{trans('word.a_apply')}}
                          </a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>    
                </div>
                <br>
                <div class="text-left"><a href="/{{Config::get('app.locale')}}/apply">< @if(Config::get('app.locale') == "th") กลับไปค้นหา @else Back to search @endif</a></div>
        @else
          <h6><i class="fa fa-times"></i> @if(Config::get('app.locale') == 'th') ไม่พบข้อมูลการรับสมัคร @else Recruitment not found. @endif</h6><br>
          <div class="text-left"><a href="/{{Config::get('app.locale')}}/apply">< @if(Config::get('app.locale') == "th") กลับไปค้นหา @else Back to search @endif</a></div>
        @endif

                @else
                  <h4><i class="fa fa-exclamation-circle"></i> 
                    @if(Config::get('app.locale') == "th")
                      กรุณาบันทึกประวัติให้ครบถ้วน ก่อนทำการยื่นสมัคร
                    @else
                      Please fill required information
                    @endif 
                  </h4>
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
  $("#recruitTable").DataTable({
     "scrollX": false
  })
</script>

@endsection