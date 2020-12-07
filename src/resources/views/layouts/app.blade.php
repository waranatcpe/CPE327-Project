<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>KMUTT Active Recruitment - @yield('title')</title>
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

        @yield('style')
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style type="text/css">
            .bg-content1{
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
    <body id="page-top" class="sidebar-toggled">
        <div id="wrapper">
            <!-- Sidebar -->
            @guest

            @else
            @if( Auth::user()->type == 0)

            @if(Config::get('app.locale') == 'th')
                  @php $lang = '/th'; @endphp
            @elseif(Config::get('app.locale') == 'en')
                  @php $lang = '/en'; @endphp
            @endif

            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <div style="padding-top: 20px;"></div>
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url($lang.'/home') }}" >

                    <div class="sidebar-brand-icon">
                        <!-- <i class="fas fa-school"></i> -->
                        
                        <img src="/images/logo.png" width="100%" class="hidden-lg" style="padding: 10px;">
                    </div>

                    <div class="sidebar-brand-text mx-3">
                        <img src="/images/@if($lang == '/th')kmutt_th.png @else{{'kmutt_en.png'}} @endif" width="100%" class="hidden-sm">
                    </div>
                   
                </a>
                <!-- Divider -->
                <div style="padding-top: 20px;"></div>
                <hr class="sidebar-divider my-0">
                
                <li class="nav-item">
                    <!-- <a class="nav-link">
                        <b>สวัสดี,</b>  {{ Auth::user()->name }}    
                    </a> -->
                    <a class="nav-link" href="{{ url($lang.'/home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>{{trans('word.m_home')}}</span></a>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                    <!-- Heading -->

                    <div class="sidebar-heading">
                        MENU
                    </div>
                    <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <i class="fas fa-fw fa-user"></i>
                                <span>{{trans('word.m_myprofile')}}</span>
                            </a>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">{{trans('word.m_myprofile')}}</h6>
                                    <a class="collapse-item" href="{{$lang}}/profile/myprofile">{{trans('word.m_profile')}}</a>
                                    <a class="collapse-item" href="{{$lang}}/profile/education">{{trans('word.m_edu')}}</a>
                                    <a class="collapse-item" href="{{$lang}}/profile/transcript">{{trans('word.m_tran')}}</a>
                                </div>
                            </div>
                        </li>
                   <!--  <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/profile/home') }}">
                            <i class="fas fa-fw fa-user"></i>
                            <span>บันทึกประวัติ</span>
                        </a>
                        
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{$lang}}/apply">
                            <i class="fas fa-fw fa-archive"></i>
                            <span>{{trans('word.m_apply')}}</span>
                        </a>
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{$lang}}/application">
                            <i class="fas fa-fw fa-file"></i>
                            <span>{{trans('word.m_apply_his')}}</span>
                        </a>
                        
                    </li>
                     <!-- <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/result') }}">
                            <i class="fas fa-fw fa-bullhorn"></i>
                            <span>ผลการคัดเลือก</span>
                        </a>
                        
                    </li> -->
                  <!-- <hr class="sidebar-divider d-none d-md-block"> -->
                   <li class="nav-item">
                        <a class="nav-link collapsed" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-fw fa-sign-out-alt"></i>
                            <span>{{trans('word.m_logout')}}</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider d-none d-md-block">
                    <br>
                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>
                </ul>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    @csrf
                </form>

                @elseif(Auth::user()->type == 1)


                <!--
                //
                // Admin
                //
                -->

                <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <div style="padding-top: 20px;"></div>
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home" >

                    <div class="sidebar-brand-icon">
                        <!-- <i class="fas fa-school"></i> -->
                        
                        <img src="/images/logo.png" width="100%" class="hidden-lg" style="padding: 10px;">
                    </div>

                    <div class="sidebar-brand-text mx-3">
                        <img src="/images/kmutt_logo.png" width="100%" class="hidden-sm">
                    </div>
                   
                </a>
                <!-- Divider -->
                <div style="padding-top: 20px;"></div>
                <hr class="sidebar-divider my-0">
                
                <li class="nav-item">
                    <!-- <a class="nav-link">
                        <b>สวัสดี,</b>  {{ Auth::user()->name }}    
                    </a> -->
                    <a class="nav-link" href="{{ url('/home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>หน้าหลัก</span></a>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                    <!-- Heading -->

                    <div class="sidebar-heading">
                        MENU
                    </div>
                   
                   
                     <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/admin/create') }}">
                            <i class="fas fa-fw fa-folder-plus"></i>
                            <span>สร้างการรับสมัคร</span>
                        </a>
                        
                    </li>

                <!--     <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/manage') }}">
                            <i class="fas fa-fw fa-cog"></i>
                            <span>จัดการการรับสมัคร</span>
                        </a>
                        
                    </li>
 -->
                 <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/admin/view') }}">
                            <i class="fas fa-fw fa-database"></i>
                            <span>สาขาที่เปิดรับสมัคร</span>
                        </a>
                        
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/admin/result') }}">
                            <i class="fas fa-fw fa-users"></i>
                            <span>ข้อมูลผู้สมัครตามสาขา</span>
                        </a>
                        
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/admin/result/closed') }}">
                            <i class="fas fa-fw fa-users"></i>
                            <span>ข้อมูลสาขาที่ปิดรับสมัคร</span>
                        </a>
                        
                    </li>

                   <!--  <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/admin/users') }}">
                            <i class="fas fa-fw fa-users-cog"></i>
                            <span>จัดการผู้ใช้งาน</span>
                        </a>
                        
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/admin/user-profiles') }}">
                            <i class="fas fa-fw fa-user-graduate"></i>
                            <span>โปรไฟล์ผู้สมัคร</span>
                        </a>
                        
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/admin/department-admin') }}">
                            <i class="fas fa-fw fa-user-tie"></i>
                            <span>จัดการผู้ใช้งาน</span>
                        </a>
                        
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/admin/department-manage') }}">
                            <i class="fas fa-fw fa-university"></i>
                            <span>จัดการภาควิชา</span>
                        </a>
                        
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/admin/users') }}">
                            <i class="fas fa-fw fa-cog"></i>
                            <span>ตั้งค่าระบบ</span>
                        </a>
                        
                    </li> -->
                  
                   <li class="nav-item">
                            <a class="nav-link collapsed" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-fw fa-sign-out-alt"></i>
                                <span>ออกจากระบบ</span>
                            </a>
                        </li>
                    <hr class="sidebar-divider d-none d-md-block">
                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>
                </ul>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    @csrf
                </form>
                

                @elseif(Auth::user()->type == 2)

                <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <div style="padding-top: 20px;"></div>
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home" >

                    <div class="sidebar-brand-icon">
                        <!-- <i class="fas fa-school"></i> -->
                        
                        <img src="/images/logo.png" width="100%" class="hidden-lg" style="padding: 10px;">
                    </div>

                    <div class="sidebar-brand-text mx-3">
                        <img src="/images/kmutt_logo.png" width="100%" class="hidden-sm">
                    </div>
                   
                </a>
                <!-- Divider -->
                <div style="padding-top: 20px;"></div>
                <hr class="sidebar-divider my-0">
                
                <li class="nav-item">
                    <!-- <a class="nav-link">
                        <b>สวัสดี,</b>  {{ Auth::user()->name }}    
                    </a> -->
                    <a class="nav-link" href="{{ url('/home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>หน้าหลัก</span></a>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                    <!-- Heading -->

                    <div class="sidebar-heading">
                        MENU
                    </div>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/dept/view') }}">
                            <i class="fas fa-fw fa-thumbtack"></i>
                            <span>ประกาศสถานที่สัมภาษณ์</span>
                        </a>
                        
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/dept/result') }}">
                            <i class="fas fa-fw fa-search"></i>
                            <span>พิจารณาสอบคัดเลือก</span>
                        </a>
                        
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/dept/final') }}">
                            <i class="fas fa-fw fa-search"></i>
                            <span>ประกาศผลสอบคัดเลือก</span>
                        </a>
                        
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('/dept/result/closed') }}">
                            <i class="fas fa-fw fa-times"></i>
                            <span>การรับสมัครที่ปิดไปแล้ว</span>
                        </a>
                        
                    </li> -->
                 
                  
                   <li class="nav-item">
                            <a class="nav-link collapsed" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-fw fa-sign-out-alt"></i>
                                <span>ออกจากระบบ</span>
                            </a>
                        </li>
                    <hr class="sidebar-divider d-none d-md-block">
                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>
                </ul>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    @csrf
                </form>


                
                @endif
                @endguest

                    <!-- End of Sidebar -->
                    <!-- Content Wrapper -->
                    <div id="content-wrapper" class="d-flex flex-column">
                        <!-- Main Content -->
                        <!-- <div id="content" class="animated fadeInLeft"> -->
                        <div id="content" class="bg-content">
                            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow hidden-lg">
                                <!-- Sidebar Toggle (Topbar) -->
                                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                                </button>
                            </nav>
                            <!-- Begin Page Content -->
                            <div class="container-fluid">
                        @if(Auth::check() && Auth::user()->type == 0)
                        <div class="text-right" style="padding-top: 20px; text-decoration: none;">
                            <i class="fa fa-globe-americas"></i>
                            <a href="/en{{ substr($_SERVER['REQUEST_URI'],3) }}">EN</a> | 
                            <a href="/th{{ substr($_SERVER['REQUEST_URI'],3) }}">TH</a>
                        </div>
                        @endif

                                <!-- <div style="padding-top: 30px;"></div> -->
                                <div style="padding-top: 15px; padding-left: 30px;">
                                    @yield('content')
                                </div>
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- End of Main Content -->
                        <!-- Footer -->
                        <footer class="sticky-footer bg-white">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <span style="line-height: 1.5rem; font-size: 1rem;">
                                    <!-- ระบบรับสมัครโครงการ Active Recruitment <br> -->
                                    @if(Config::get('app.locale') == 'th')
                                          สำนักงานคัดเลือกและสรรหานักศึกษา
                                            มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี<br> <!-- โทร 02 470 8333 -->
                                    @elseif(Config::get('app.locale') == 'en')
                                          Admissions and Recruitment Office | KMUTT<br> <!-- Contact +662 470 8333 -->
                                    @endif
                                    
                                       <!-- | <small>Theme by SB Admin 2</small>                                     -->
                                    </span>
                                </div>
                            </div>
                        </footer>
                        <!-- End of Footer -->
                    </div>
                    <!-- End of Content Wrapper -->
                </div>

       <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <!-- Bootstrap core JavaScript-->
        <script src="/js/jquery.min.js"></script>
       

        <script type="text/javascript">
        var x = window.matchMedia("(max-width: 768px)").matches;
            if(x){
                $("body").toggleClass("sidebar-toggled");
                $(".sidebar").toggleClass("toggled");
            }
        </script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="/js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
        <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Page level custom scripts -->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-7B85QCB8S3"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-7B85QCB8S3');
        </script>

    </body>
</html>