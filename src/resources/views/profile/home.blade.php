@extends('layouts.app')
@section('title', 'บันทึกประวัติ')

@section('content')
@if(Config::get('app.locale') == 'th')
  @php $lang = '/th'; @endphp
@elseif(Config::get('app.locale') == 'en')
  @php $lang = '/en'; @endphp
@endif

    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary"> {{trans('word.p_title')}}</h2>
    </div>
    <div class="card-body">
        @if($edit)
       <div class="row">
           <div class="col-md-3">
               <div class="card text-white bg-primary-dashboard mb-3" >
                  <div class="card-body">
                    <h5 class="card-title"> {{trans('word.p_profile')}} 
                      @if($status['profile'])
                          <a class="badge badge-success" style="background-color: #00a205; border-radius: 15px;">{{trans('word.pass')}}</a>
                      @else
                        <a class="btn btn-sm" style="background-color: #e83535; border-radius: 15px;">{{trans('word.fail')}}</a>
                      @endif 
                    </h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        {{trans('word.p_profile_des')}}
                    </p>
                    <div class="text-right">
                        <a href="{{$lang}}/profile/myprofile" class="btn btn-dark">{{trans('word.p_button')}}</a>
                    </div>
                     
                  </div>
                </div>
           </div>


           <div class="col-md-3">
               <div class="card text-white bg-primary-dashboard mb-3" >
                  <div class="card-body">
                    <h5 class="card-title"> {{trans('word.p_edu')}} 
                      @if($status['education'])
                          <a class="badge badge-success" style="background-color: #00a205; border-radius: 15px;">{{trans('word.pass')}}</a>
                      @else
                        <a class="btn btn-sm" style="background-color: #e83535; border-radius: 15px;">{{trans('word.fail')}}</a>
                      @endif 
                    </h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        {{trans('word.p_edu_des')}}
                    </p>
                    <div class="text-right">
                        <a href="{{$lang}}/profile/education" class="btn btn-dark">{{trans('word.p_button')}}</a>
                    </div>
                  </div>
                </div>
           </div>

           <div class="col-md-3">
               <div class="card text-white bg-primary-dashboard mb-3" >
                  <div class="card-body">
                    <h5 class="card-title"> {{trans('word.p_tran')}} 
                      @if($status['transcript'])
                          <a class="badge badge-success" style="background-color: #00a205; border-radius: 15px;">{{trans('word.pass')}}</a>
                      @else
                        <a class="btn btn-sm" style="background-color: #e83535; border-radius: 15px;">{{trans('word.fail')}}</a>
                      @endif 
                    </h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        {{trans('word.p_tran_des')}}
                    </p>
                    <div class="text-right">
                        <a href="{{$lang}}/profile/transcript" class="btn btn-dark">{{trans('word.p_button')}}</a>
                    </div>
                     
                  </div>
                </div>
           </div>
         </div>

            
       @else


       <!-- Disallow Edit -->
       <div class="alert alert-warning">
        <p style="line-height: 30px;"><b><i class="fa fa-exclamation-triangle"></i> 
          @if(Config::get('app.locale') == 'th')
            คุณยื่นใบสมัครเรียบร้อยแล้ว ไม่สามารถแก้ไขข้อมูลได้ หากต้องการแก้ไข ต้องยกเลิกใบสมัครแล้วสมัครใหม่
          @else
            You have submitted an application form, and it can't be edited the information If you would like to edit it, you must cancel the application form and reapply it.
          @endif
          </p>
        <div class="text-right">
          <a href="/{{Config::get('app.locale')}}/application"><button class="btn btn-warning">
            @if(Config::get('app.locale') == 'th')
              ติดตามสถานะการสมัคร
            @else
              Applications Status
            @endif
          </button></a>
        </div>
       </div>


       @endif
       <!-- Feedback Session -->
       @if(App\UserProfile::where('user_id', Auth::user()->id)->select('feedback')->first()->feedback != NULL)
       <hr>
          <h4 style="color: #ec6b26 !important;"><i class="fa fa-comments"></i> Admissions Feedback</h4>
          <div style="padding-left: 30px; padding-top: 15px;" id="feedback">
            {{App\UserProfile::where('user_id', Auth::user()->id)->select('feedback')->first()->feedback}}
          </div>
       @endif
    </div>
@endsection
