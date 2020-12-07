@extends('layouts.app')
@section('title', 'ผลการเรียน')

@section('content')

@if(isset($status) && $status == 200)
  <script type="text/javascript">swal("{{trans('word.success')}}", "","success").then(()=>{
    window.location = '/{{Config::get("app.locale")}}/profile/home'
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
          <a href="/profile/home"><font color="#ec6b26">{{trans('word.t_title')}}</a></font> / 
          <small><font color="#999">{{trans('word.t_subtitle')}}</font></small></h2>
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
        <div class="alert alert-warning" style="line-height: 1.5rem;">
          <i class="fa fa-exclamation-circle"></i>
          @if(Config::get('app.locale') == 'th')
            <b>โปรดอัปโหลดในขนาดไฟล์ไม่เกิน 20 MB และเป็นไฟล์ PDF หรือรูปภาพเท่านั้น <br> <u>สำเนาผลการเรียนควรอัพโหลดทั้งด้านหน้าและด้านหลัง ในไฟล์เดียวกัน</u></b>
          @else
            <b>File limited size not over 10MB, and as PDF/Image file only.</b>
          @endif
           
         </div>

       <form method="post" action="" enctype="multipart/form-data">
         @csrf
    
         <h5><i class="fa fa-upload"></i> {{trans('word.t_upload')}} <font color="red">*</font></h5>
         
        <div class="form-row">
          <div class="form-group col-md-12">
            <!-- <label>Portfol</label> -->
            <input type="file" name="transcript" accept="application/pdf,image/png,image/jpeg" class="form-control">
          </div>
        </div>

        @if($profileData->transcript != NULL)
        <div class="badge badge-success" style="margin-bottom: 20px;">
          <i class="fa fa-upload"></i> {{trans('word.t_success')}}
        </div>
          >
          <a href="{{ env('BASE_FILE_STORAGE') }}/{{$profileData->transcript}}" target="_blank">{{$profileData->transcript}}</a>
        @else
        <div class="badge badge-danger" style="margin-bottom: 20px;">
          Not uploaded !
        </div>
        @endif
        


         <div class="form-row">
          <div class="form-group col-md-12">
            <h5><i class="fa fa-link"></i> {{trans('word.t_link')}} </h5>
            <input type="text" placeholder="https://" class="form-control" name="link" value="{{$profileData->link}}">
          </div>
        </div>
<hr> 
<div style="padding-bottom: 30px;"></div>
       <div class="text-right">
         <button style="width: 100px;" type="submit" class="btn btn-dark">{{trans('word.t_save')}}</button>
       </div>
        
      </form>
  </div>

<!-- </div> -->
@endsection
