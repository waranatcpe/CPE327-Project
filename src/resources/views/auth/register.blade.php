<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>KMUTT Active Recruitment - ลงทะเบียนผู้ใช้งาน</title>
        <meta http-equiv="Content–Type" content="text/html ; charset= utf–8"/>
        <meta name="robots" content="index,follow" />
        <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree:500&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/animate.css">
        
        <!-- Custom fonts for this template-->
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
        
        <!-- Custom styles for this template-->
        <link href="/css/sb-admin-2.css" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">
        <script src="/js/sweet-alert.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style type="text/css">
          body{
            background: url('/images/bg.png');
            width: 100%;
            height: 90vh;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
          }
        </style>
    </head>
<body>
<div class="container" style="padding-top: 0px;">

    <div class="row justify-content-center">
        <div class="col-md-9" >

            <div class="card o-hidden border-0 shadow-lg my-5"  style="border-radius: 20px;">
                <!-- <div class="card-header">{{ __('ลงทะเบียน') }}</div> -->


                <div class="card-body">
                    
                <center>
                    <!-- <div class="text-right" style="text-decoration: none;">
                          <a href="/en/register">EN</a> | 
                          <a href="/th/register">TH</a>
                        </div> -->
                    <div style="padding-top: 0px; padding-bottom: 20px;">
                        <img src="/images/{{trans('word.login_logo')}}" width="300">
                    </div>
                    <h1 class="h4 text-gray-900 mb-4">{{trans('word.reg_title')}}</h1>
                </center>

                    <form method="POST" name="register" onsubmit="return checkForm()" action="/register">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{trans('word.reg_prefix')}}</label>

                            <div class="col-md-6">
                               <select name="prefix" class="form-control" required="">
                                  <option value="{{ old('prefix') }}" selected="false">
                                     {{ old('prefix') }}
                                  </option>
                                  <option>{{trans('word.reg_prefix_mr')}}</option>
                                  <option>{{trans('word.reg_prefix_ms')}}</option>
                                </select>

                                @if ($errors->has('prefix'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('prefix') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{trans('word.reg_firstname')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{trans('word.reg_lastname')}}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <div class="row">
                                <div class="col-md-5"><input onclick="ch_view()" checked type="radio" name="type" value="1"> {{trans('word.reg_citizen_id')}} <div style="padding-bottom: 8px;"></div> </div>
                                <div class="col-md-7"><input onclick="ch_view()" type="radio" name="type" value="2"> @php echo trans('word.reg_passport'); @endphp </div>
                              </div>
                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">
                                <text id="type_view">{{trans('word.reg_citizen_id')}}</text>
                            </label>

                            <div class="col-md-6">
                                <input id="username" type="text"
                                       class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                       name="username" value="{{ old('username') }}" 
                                       id="usr"
                                       required
                                       onKeyUp="
                                            if((document.register.type.value == 1 || document.register.type.value == '') && isNaN(this.value)){ 
                                                swal('กรุณากรอกตัวเลข','','warning').then(()=>{
                                                    this.value = ''
                                                    this.focus()
                                                }) 
                                            }" 
                                       maxlength="13">
                        
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{trans('word.reg_email')}}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{trans('word.reg_password')}}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{trans('word.reg_password_cf')}}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" style="background-color: #F37733; color:#fff; border-color: #f37733;"  class="btn btn-block btn-primary"><i class="fa fa-check"></i> 
                                    {{trans('word.reg_submit')}}
                                </button>
                                <!-- <hr> --><br>
                                <div class="text-right">
                                 {{trans('word.reg_have_acc')}}
                                <a href="{{trans('word.reg_sign_in_link')}}">
                                {{trans('word.reg_sign_in')}}
                                </a>
                            </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer style="padding-bottom: 15px; width: 100%; color:#fff; position: fixed; left: 0; bottom: 0; text-align: left;">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span style="line-height: 1.5rem; font-size: 1rem;">
            Admissions and Recruitment Office KMUTT
          </span>
        </div>
      </div>
    </footer>

<!-- modal zone -->
<div style="background: url('/images/bg.png');
        width: 100%;
        height: 100%;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        background-attachment: fixed;
        padding-top: 200px;" id="_edit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F37733;
    color: #fff;
    border-color: #f37733;">
        <h5 class="modal-title" id="exampleModalLongTitle">  
        <i class="fa fa-globe-asia"></i> Please Choose Your Language
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6" style="padding-bottom: 20px; ">
            <button onclick="chlang(1)" style="height: 100px; font-size: 20px;" class="btn btn-block btn-outline-secondary">ภาษาไทย</button>
          </div>
          <div class="col-md-6">
            <button onclick="chlang(2)" style="height: 100px; font-size: 20px;" class="btn btn-block btn-outline-secondary">English</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WDZEME793P"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-WDZEME793P');
</script>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    @if(!isset($_COOKIE['language']))
    <script defer type="text/javascript">
      $('#_edit').modal('show')
      function chlang(id){
        if(id==1){
          document.cookie = "language=th; path=/; max-age=" + 30*24*60*60;
          window.location = '/th/register'
        }else if(id==2){
          document.cookie = "language=en; path=/; max-age=" + 30*24*60*60;
          window.location = '/en/register'
        }
      }
    </script>
     @else
    <script type="text/javascript">
      function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
      }
      var language = getCookie("language")
      var path = window.location.pathname

      if(language != path.substr(1,2)){
        window.location = '/'+language+'/register'
      }else{
        console.log('welcome')
      }
    </script>
    @endif
</body>
<script type="text/javascript">
    $('#type_view').html('@if(Config::get("app.locale") == "th") หมายเลขบัตรประชาชน @else ID Card No. @endif')
    
    function ch_view(){
      if(document.register.type.value == 1 || document.register.type.value == ""){
        $("#type_view").html('@if(Config::get("app.locale") == "th") หมายเลขบัตรประชาชน @else ID Card No. @endif')
      }else{
        $("#type_view").html('@if(Config::get("app.locale") == "th") หมายเลขพาสปอร์ต @else Passport No. @endif')
      }
    }

    function checkID(id) 
    { 
    if(id.length != 13) return false; 
    for(i=0, sum=0; i < 12; i++) 
    sum += parseFloat(id.charAt(i))*(13-i); if((11-sum%11)%10!=parseFloat(id.charAt(12))) 
    return false; return true;
    }

    function checkForm() 
    { 
        if(document.register.type.value == 1){
          if(!checkID(document.register.username.value)) {
              swal("{{trans('word.reg_error')}}","","warning")
              return false;
          }else{            
              return true;
          }
        }else{
          return true;
        }
        
    }
</script>
