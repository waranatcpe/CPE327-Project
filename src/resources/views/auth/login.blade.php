@if(Auth::check()) <script type="text/javascript">window.location = "/home"</script> @endif
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KMUTT Active Recruitment :: Sign-in</title>
    <meta http-equiv="Content–Type" content="text/html ; charset= utf–8"/>
    <meta name="Description" content="KMUTT Active Recruitment System.">
    <meta name="keywords" content="ARKMUTT, AR, KMUTT, Admission, Active Recruitment, บางมด," />
    <meta name="author" content="waranat.stk@mail.kmutt.ac.th" />
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
    <div class="container">
      <!-- Outer Row -->
      <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-12 col-md-5">

            <!-- <div style="padding-bottom: 1px;"></div> -->
          <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius: 20px;">
            <div class="card-body p-0" >
              <!-- Nested Row within Card Body -->
              <div class="row">
                <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                <div class="col-lg-12" >
                  <div class="p-5">
                    <div class="text-center">
                      <center>
                        <!-- <div class="text-right" style="text-decoration: none;">
                          <a href="/en/login">EN</a> | 
                          <a href="/th/login">TH</a>
                        </div> -->
                <div style="padding-top: 0px; padding-bottom: 50px;">
                    <img src="/images/{{trans('word.login_logo')}}" alt="kmutt-logo" width="300">
                    <!-- <img src="/images/KMUTT.png" width="150"> -->
                </div>               
            </center>
                      <h1 class="h4 text-gray-900 mb-2">{{trans('word.login_title')}}</h1>
                      <h1 class="h5 text-gray-500 mb-4">{{trans('word.login_project')}}</h1>
                    </div>
                    <form method="POST" action="/login">
                      @csrf
                      <div class="form-group mb-4">
                        <input id="login" type="text"
                        class="form-control-user form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                        name="login" value="{{ old('username') ?: old('email') }}" required autofocus aria-describedby="emailHelp" placeholder="{{trans('word.login_id')}}">
                        @if ($errors->has('username') || $errors->has('email'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                        </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <input id="password" type="password" class="mb-4 form-control-user form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{trans('word.login_password')}}" name="password" required>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                      </div>
                      <!-- <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                          <input type="checkbox" class="custom-control-input" id="customCheck">
                          <label style="padding-top: 7px;" class="custom-control-label" for="customCheck">Remember Me</label>
                        </div>
                      </div> -->
                      <div class="text-center">
                        <button type="submit" name="LoginSubmit" class="btn btn-block btn-primary btn-user" style="background-color: #F37733; color:#fff; border-color: #f37733;"><i class="fa fa-sign-in-alt"></i> {{trans('word.login_sign_in')}}</button>
                      </div>
                      <input type="text" value="{{Config::get('app.locale')}}" hidden name="language">
                      
                    </form>
                    <br>
                    <div class="text-center" style="padding-top: 10px;">
                                <!-- ยังไม่มีผู้ใช้ ? -->
                                <a href="{{trans('word.login_register_link')}}">
                                    {{trans('word.login_register')}}
                                </a><br><div style="padding-bottom: 7px;"></div>
                                <!-- ลืมรหัสผ่าน ? -->
                                <a href="/password/reset">
                                    {{trans('word.login_reset')}}
                                </a>
                    
                  </div>
                </div>
              </div>
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9KWHX49EX9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-9KWHX49EX9');
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
          window.location = '/th/login'
        }else if(id==2){
          document.cookie = "language=en; path=/; max-age=" + 30*24*60*60;
          window.location = '/en/login'
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
        window.location = '/'+language+'/login'
      }else{
        console.log('welcome')
      }
    </script>
    @endif

  </body>