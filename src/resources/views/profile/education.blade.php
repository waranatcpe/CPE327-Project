@extends('layouts.app')
@section('title', 'บันทึกประวัติการศึกษา')

@section('content')

@if(isset($status) && $status == 200)
  <script type="text/javascript">swal("{{trans('word.success')}}", "","success").then(()=>{
    window.location = '/{{trans("word.lang")}}/profile/home'
  })</script>
@endif

@if($edit == 0)
  @php
    header("Location: " . URL::to(Config::get('app.locale').'/profile/home'), true, 302);
    exit();
  @endphp
@endif

@section('style')
<link rel="stylesheet" type="text/css" href="/css/custom.css">
@endsection

<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">
          <a href="/profile/home"><font color="#ec6b26">{{trans('word.e_title')}}</a></font> / 
          <small><font color="#999">{{trans('word.e_subtitle')}}</font></small></h2>
    </div>
    <div class="card-body">
        <!-- <p><b>สวัสดี,</b>  {{ Auth::user()->name }}</p> -->
       <!-- {{$profileData->citizen_id}} -->
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
         <div class="form-row">
           <div class="form-group col-md-8">
            <label >{{trans('word.e_school')}} <font color="red">*</font></label>
            <input type="text" class="form-control" name="school" value="{{$profileData->school}}" autocomplete="no" placeholder="{{trans('word.e_school')}}">
            <small>{{trans('word.e_school_w')}}</small>
          </div>
          <div class="form-group col-md-2">
            <label >{{trans('word.e_province')}} <font color="red">*</font></label>
            <input type="text" class="form-control" name="province" value="{{$profileData->province}}" autocomplete="no" placeholder="{{trans('word.e_province')}}">
            <!-- <select class="form-control" name= "province">
            <option value="@if($profileData->province == NULL) @else {{$profileData->province}} @endif">@if($profileData->province == NULL) - เลือกจังหวัด - @else {{$profileData->province}} @endif</option>
              @php
                for($i=0; $i<76; $i++){
                  echo "<option>".$province[$i]."</option>
                  ";
                }
              @endphp
            </select> -->
          </div>
          <div class="form-group col-md-2">
            <label >{{trans('word.e_edutype')}} <font color="red">*</font></label>
            <select class="form-control" name="edu_type">
              <option>{{$profileData->edu_type}}</option>
              <option>{{trans('word.e_t1')}}</option>
              <option>{{trans('word.e_t2')}}</option>
              <option>{{trans('word.e_t2_1')}}</option>
              <option>{{trans('word.e_t3')}}</option>
              <option>{{trans('word.e_t4')}}</option>
            </select>
          </div>
         </div>

         <h5><i class="fa fa-file"></i> {{trans('word.e_tran')}}</h5>
         <div class="table-responsive">
         <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="20%"><center>{{trans('word.e_th_no')}}</center></th>
              <th width="40%" ><center>{{trans('word.e_th_gpa')}}</center></th>
              <th><center>{{trans('word.e_th_cre')}}</center></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{trans('word.e_mth')}}</td>
              <td><input type="number" step="0.01" min="0" max="4" class="form-control" name="GPA_MTH" value="{{$profileData->GPA_MTH}}"></td>
              <td><input type="number" step="0.1" max="50" class="form-control" name="CRE_MTH" value="{{$profileData->CRE_MTH}}"></td>
            </tr> 
            <tr>
              <td>{{trans('word.e_sci')}}</td>
              <td><input type="number" step="0.01" min="0" max="4" class="form-control" name="GPA_SCI" value="{{$profileData->GPA_SCI}}"></td>
              <td><input type="number" step="0.1" max="50" class="form-control" name="CRE_SCI" value="{{$profileData->CRE_SCI}}"></td>
            </tr>            
            <tr>
              <td>{{trans('word.e_eng')}}</td>
             <td><input type="number" step="0.01" min="0" max="4" class="form-control" name="GPA_ENG" value="{{$profileData->GPA_ENG}}"></td>
             <td><input type="number" step="0.1" max="50" class="form-control" name="CRE_ENG" value="{{$profileData->CRE_ENG}}"></td>
            </tr> 
            <tr>
              <td>{{trans('word.e_gpax')}}</td>
             <td colspan='2'><input type="number" step="0.01" min="0" max="4" class="form-control" name="GPAX" value="{{$profileData->GPAX}}"></td>
            </tr> 
          </tbody>
         </table>
         </div>

         <h5><i class="fa fa-globe-asia"></i> {{trans('word.e_eng_test')}} <small>{{trans('word.e_eng_test_w')}}</small></h5>
         <div class="form-row">
           <div class="form-group col-md-1">
            <label >IELTS</label>
            <input type="text" class="form-control" placeholder="" name="IELTS" value="{{$profileData->IELTS}}">
          </div>
          <div class="form-group col-md-1">
            <label >TOEFL</label>
            <input type="text" class="form-control" placeholder="" name="TOEFL" value="{{$profileData->TOEFL}}">
          </div>
          <div class="form-group col-md-1">
            <label >TOEIC</label>
            <input type="text"  class="form-control" placeholder="" name="TOEIC" value="{{$profileData->TOEIC}}">
          </div>
          <div class="form-group col-md-1">
            <label >CU-TEP</label>
            <input type="text" class="form-control" placeholder="" name="CUTEP" value="{{$profileData->CUTEP}}">
          </div>
          <div class="form-group col-md-1">
            <label >RMIT</label>
            <input type="text" class="form-control" placeholder="" name="RMIT" value="{{$profileData->RMIT}}">
          </div>
         </div>

          <hr>
          <div style="padding-bottom: 30px;"></div>
                 <div class="text-right">
                   <button style="width: 100px;" type="submit" class="btn btn-dark">{{trans('word.e_save')}}</button>
                 </div>
                  
                </form>
            </div>
          </div>
                 
    </div>
<!-- </div> -->
@endsection
