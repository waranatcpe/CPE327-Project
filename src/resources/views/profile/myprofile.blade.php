@extends('layouts.app')
@section('title', 'บันทึกประวัติส่วนตัว')

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
          <a href="/profile/home"><font color="#ec6b26">{{trans('word.myprofile_title')}}</a></font> / 
          <small><font color="#999">{{trans('word.myprofile_subtitle')}}</font></small></h2>
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
         <h5><i class="fa fa-id-card-alt"></i> {{trans('word.myprofile_profile_data')}}</h5>
        <div class="form-row">
          <div class="form-group col-md-3">
            <label style="color : #999;">{{trans('word.myprofile_citizen_id')}} :: {{$profileData->citizen_id}}</label>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-2">
            <label>{{trans('word.myprofile_prefix')}} <font color="red">*</font></label>
            <select name="prefix" class="form-control">
              <option value="{{$profileData->prefix}}"  selected>
                @if($profileData->prefix == NULL)
                  เลือก ...
                @else
                  {{$profileData->prefix}}
                @endif
              </option>
              <option>{{trans('word.myprofile_prefix_mr')}}</option>
              <option>{{trans('word.myprofile_prefix_ms')}}</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label >{{trans('word.myprofile_firstname')}} <font color="red">*</font></label>
            <input type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{$profileData->firstname}}" required placeholder="{{trans('word.myprofile_firstname')}}">
          </div>
          <div class="form-group col-md-3">
            <label >{{trans('word.myprofile_lastname')}} <font color="red">*</font></label>
            <input type="text" class="form-control" name="lastname" value="{{$profileData->lastname}}" placeholder="{{trans('word.myprofile_lastname')}}">
          </div>
          <div class="form-group col-md-4">
            <label >{{trans('word.myprofile_email')}} <font color="red">*</font></label>
            <input type="email" name='email' readonly class="form-control" value="{{$profileData->email}}" placeholder="{{trans('word.myprofile_email')}}">
          </div>
        </div>


        <div class="form-row">
          <div class="form-group col-md-3">
            <label>{{trans('word.myprofile_facebook')}}</label>
            <input type="text" class="form-control" name="facebook" value="{{$profileData->facebook}}"  placeholder="{{trans('word.myprofile_facebook')}}">
          </div>
          <div class="form-group col-md-3">
            <label >{{trans('word.myprofile_line')}}</label>
            <input type="text" name='line' class="form-control" value="{{$profileData->lineID}}" placeholder="{{trans('word.myprofile_line')}}">
          </div>
          <div class="form-group col-md-3"> 
            <label >{{trans('word.myprofile_tel1')}} <font color="red">*</font></label>
            <input type="text" maxlength="10" class="form-control" value="{{$profileData->telephone}}" name="telephone" placeholder="{{trans('word.myprofile_tel1')}}">
          </div>
          <div class="form-group col-md-3">
            <label >{{trans('word.myprofile_tel2')}}</label>
            <input type="text" maxlength="10" class="form-control" value="{{$profileData->telephone2}}" name="telephone2" placeholder="{{trans('word.myprofile_tel2')}}">
          </div>
        </div>
        <hr>

        <h5><i class="fa fa-map-marked-alt"></i> {{trans('word.myprofile_address_sec')}} </h5><!-- :: ข้อมูลตามบัตรประชาชน<br> --><br>

        <div class="form-row">
          <div class="form-group col-md-12">
            <label>{{trans('word.myprofile_address')}} <font color="red">*</font></label>
            <textarea class="form-control" rows="3" name="address" >{{$profileData->address}}</textarea>
          </div>
          
         </div>

<hr>
<div style="padding-bottom: 30px;"></div>
       <div class="text-right">
         <button style="width: 100px;" type="submit" class="btn btn-dark">{{trans('word.myprofile_save')}}</button>
       </div>
        
      </form>
  </div>
</div>
       
    </div>
<!-- </div> -->
@endsection
