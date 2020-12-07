<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KMUTT Active Recruitment :: Reset-Password</title>
    <meta http-equiv="Content–Type" content="text/html ; charset= utf–8"/>
    <meta neme="Description" content="โครงการ Active Recruitment KMUTT"/>
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

        <div class="col-xl-8 col-lg-12 col-md-5">

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
                <div style="padding-top: 0px; padding-bottom: 50px;">
                    <img src="/images/{{trans('word.login_logo')}}" width="300">
                    <!-- <img src="/images/KMUTT.png" width="150"> -->
                </div>               
                </center>
                      <h1 class="h4 text-gray-900 mb-2">Reset Password Form</h1>
                    </div>
                <div class="card-body">
                <form method="POST" action="/password/reset">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #F37733; color: #fff; border-color: #f37733;">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                    <br>
                   
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
           
            Admission and Recruitment Office KMUTT
          
          </span>
        </div>
      </div>
    </footer>

</body>

