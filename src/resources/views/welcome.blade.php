@if(Auth::check())
    @php
        header("Location: " . URL::to('/home'), true, 302);
        exit();
    @endphp
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>KMUTT Active Recruitment</title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.css">
    <link rel="stylesheet" href="/css/templatemo-lava.css">
    <link rel="stylesheet" href="/css/owl-carousel.css">
</head>
<body>
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="/" class="logo">
                            KMUTT AR
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#welcome" class="menu-item">Home</a></li>
                            <li class="scroll-to-section"><a href="#about" class="menu-item">How to</a></li>
                            <li class="scroll-to-section"><a href="#testimonials" class="menu-item">Portfolio</a>
                            </li>
                            <li class="submenu">
                                <a href="javascript:;">other link</a>
                                <ul>
                                    <li><a href="https://kmutt.ac.th" class="menu-item">KMUTT</a></li>
                                    <li><a href="https://admission.kmutt.ac.th" class="menu-item">ADMISSION</a></li>
                                </ul>
                            </li>
                            <li class="scroll-to-section" onclick="window.location = '/register'"><a href="/register" class="menu-item">Register Now</a></li>
                            <li class="scroll-to-section" onclick="window.location = '/login'"><a href="/register" class="menu-item">Login</a></li>
                             <!-- <li class="scroll-to-section"><a href="#contact-us" class="menu-item">Register Now</a></li> -->
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->


    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">

        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="left-text col-lg-6 col-md-12 col-sm-12 col-xs-12"
                        data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                        <h1>Active Recruitment <em>KMUTT</em></h1>
                        <p>โครงการ Active Recruitment เป็นหนึ่งในโครงการรับสมัครบุคคลเข้าศึกษาต่อระดับปริญญาตรี
                            โดยมีวัตถุประสงค์เพื่อเปิดโอกาสให้นักเรียนที่มีผลการเรียนดี มีความสามารถพิเศษเฉพาะด้าน กล้าแสดงออก
                            ส่งเอกสารหรือแฟ้มสะสมผลงาน (Portfolio) เพื่อสมัครเข้าศึกษาในสาขาวิชาที่ตนเองสนใจ ภายใต้เกณฑ์
                            การรับสมัครของคณะ/ภาควิชา/สาขาวิชา</p> 
                        <a href="#about" class="main-button-slider">ศึกษาเพิ่มเติม</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <div class="features-item">
                        <div class="features-icon">
                            <h2>01</h2>
                            <img src="/images/features-icon-1.png" alt="">
                            <h4>ศึกษารายละเอียด</h4>
                            <p>ผู้สมัครศึกษารายละเอียดการรับสมัครให้ครบถ้วน และจัดทำแฟ้มสะสมผลงานให้สอดคล้อง
                            กับสาขาวิชาที่ตนเองสนใจ
                            </p>
                           <!--  <a href="#testimonials" class="main-button">
                                Read More
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12"
                    data-scroll-reveal="enter bottom move 30px over 0.6s after 0.4s">
                    <div class="features-item">
                        <div class="features-icon">
                            <h2>02</h2>
                            <img src="/images/features-icon-2.png" alt="">
                            <h4>ยื่นสมัคร</h4>
                            <p>สมัครสมาชิกเว็บไซต์ KMUTT Active Recruitment และทำการยื่นสมัครตามสาขาที่ตนเองสนใจ
                            </p>
                            <!-- <a href="#testimonials" class="main-button">
                                Discover More
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12"
                    data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                    <div class="features-item">
                        <div class="features-icon">
                            <h2>03</h2>
                            <img src="/images/features-icon-3.png" alt="">
                            <h4>รอประกาศผล</h4>
                            <p>รอประกาศผลผู้มีสิทธิ์สอบสัมภาษณ์ ผ่านทางเว็บไซต์สำนักงานคัดเลือกและสรรหานักศึกษา มจธ.</p>
                            <!-- <a href="#testimonials" class="main-button">
                                More Detail
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <div class="left-image-decor"></div>

    <!-- ***** Features Big Item Start ***** -->
<!--     <section class="section" id="promotion">
        <div class="container">
            <div class="row">
                <div class="left-image col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix-big"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="/images/left-image.png" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="right-text offset-lg-1 col-lg-6 col-md-12 col-sm-12 mobile-bottom-fix">
                    <ul>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                            <img src="/images/about-icon-01.png" alt="">
                            <div class="text">
                                <h4>Vestibulum pulvinar rhoncus</h4>
                                <p>Please do not redistribute this template ZIP file for a download purpose. You may <a
                                rel="nofollow" href="https://templatemo.com/contact" target="_parent">contact</a> us for
                            additional licensing of our template or to get a PSD file.</p>
                            </div>
                        </li>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.5s">
                            <img src="/images/about-icon-02.png" alt="">
                            <div class="text">
                                <h4>Sed blandit quam in velit</h4>
                                <p>You can <a rel="nofollow"
                                        href="https://templatemo.com/tm-540-lava-landing-page">download Lava
                                        Template</a> from our website. Duis viverra, ipsum et scelerisque placerat, orci
                                    magna consequat ligula.</p>
                            </div>
                        </li>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.6s">
                            <img src="/images/about-icon-03.png" alt="">
                            <div class="text">
                                <h4>Aenean faucibus venenatis</h4>
                                <p>Phasellus in imperdiet felis, eget vestibulum nulla. Aliquam nec dui nec augue
                                    maximus porta. Curabitur tristique lacus.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> -->
    <!-- ***** Features Big Item End ***** -->

    <div class="right-image-decor"></div>

    <!-- ***** Testimonials Starts ***** -->
    <section class="section" id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="center-heading">
                        <h2>จัดเตรียม <em>แฟ้มสะสมผลงาน</em></h2>
                        <p>เอกสารในการสมัคร ก็จะมีแฟ้มสะสมผลงานและรายละเอียดของแฟ้มสะสมผลงานประกอบด้วยดังนี้</p>
                    </div>
                </div>
                <div class="col-lg-10 col-md-12 col-sm-12 mobile-bottom-fix-big"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <div class="owl-carousel owl-theme">
                        <div class="item service-item">
                            <div class="author">
                                <i class="fa"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>หน้าปก</h4>
                                <p>ระบุคณะและสาขาวิชาที่ต้องการสมัคร</p>
                                <span>( 1 )</span>
                            </div>
                        </div>
                        <div class="item service-item">
                            <div class="author">
                                <i class="fa"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>ประวัติส่วนตัว</h4>
                                <p>ระบุหมายเลขโทรศัพท์และอีเมลให้ชัดเจน</p>
                                <span>( 2 )</span>
                            </div>
                        </div>
                        <div class="item service-item">
                            <div class="author">
                                <i class="fa"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>สำเนาบัตรประชาชน</h4>
                                <p>ลงชื่อรับรองสำเนาถูกต้อง</p>
                                <span>( 3 )</span>
                            </div>
                        </div>
                        <div class="item service-item">
                            <div class="author">
                                <i class="fa"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>ประวัติการศึกษา</h4>
                                <p>ระบุรายละเอียดเกี่ยวกับการศึกษาให้ครบถ้วน</p>
                                <span>( 4 )</span>
                            </div>
                        </div>
                        <div class="item service-item">
                            <div class="author">
                                <i class="fa"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>สำเนาใบแสดงผลการเรียน (ปพ.1)</h4>
                                <p>ลงชื่อรับรองสำเนาถูกต้อง</p>
                                <span>( 5 )</span>
                            </div>
                        </div>
                        <div class="item service-item">
                            <div class="author">
                                <i class="fa"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>สำเนาผลการทดสอบภาษาอังกฤษ</h4>
                                <p>เช่น IELTS, TOEFL, TOEIC, CU-TEP </p>
                                <span>( 6 )</span>
                            </div>
                        </div>
                        <div class="item service-item">
                            <div class="author">
                                <i class="fa"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>ประวัติผลงาน</h4>
                                <p>รางวัลที่ได้รับ กิจกรรมที่เข้าร่วม และผลงานอื่น ๆ ที่เกี่ยวข้องกับสาขาวิชา
                                    ที่สมัคร</p>
                                <span>( 7 )</span>
                            </div>
                        </div>
                        <div class="item service-item">
                            <div class="author">
                                <i class="fa"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>เอกสารเพิ่มเติม</h4>
                                <p> ตามเงื่อนไขของคณะ/ภาควิชากำหนด </p>
                                <span>( 8 )</span>
                            </div>
                        </div>
                        
                        <!-- <div class="item service-item">
                            <div class="author">
                                <i><img src="/images/testimonial-author-1.png" alt="Second Author"></i>
                            </div>
                            <div class="testimonial-content">
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>Martino Tino</h4>
                                <p>“Morbi non mi luctus felis molestie scelerisque. In ac libero viverra, placerat est
                                    interdum, rhoncus leo.”</p>
                                <span>Web Analyst</span>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Testimonials Ends ***** -->


    <!-- ***** Footer Start ***** -->
    <footer id="contact-us">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <!-- ***** Contact Form Start ***** -->
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="contact-form">
                            <form id="contact" action="" method="post">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <fieldset>
                                            <input name="name" type="text" id="name" placeholder="Full Name" required=""
                                                style="background-color: rgba(250,250,250,0.3);">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <fieldset>
                                            <input name="email" type="text" id="email" placeholder="E-Mail Address"
                                                required="" style="background-color: rgba(250,250,250,0.3);">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <textarea name="message" rows="6" id="message" placeholder="Your Message"
                                                required="" style="background-color: rgba(250,250,250,0.3);"></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="main-button">Send Message
                                                Now</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                    <!-- ***** Contact Form End ***** -->
                    <div class="right-content col-lg-6 col-md-12 col-sm-12">
                        <h2>More About <em>KMUTT</em></h2>
                        <p>126 ถนนประชาอุทิศ แขวงบางมด เขตทุ่งครุ กรุงเทพฯ 10140
                            King Mongkut's University of Technology Thonburi
                            Pracha Uthit Rd., Bang Mod, Thung Khru, Bangkok
                            10140
                            <br><br>
                            มจธ.บางมด ตั้งอยู่เลขที่ 126 ถนนประชาอุทิศ
                            แขวงบางมด เขตทุ่งครุ กรุงเทพฯ 10140 มีพื้นที่มากกว่า
                            134 ไร่ เริ่มดำเนินการตั้งแต่ปี พ.ศ. 2503 มจธ.บางมด
                            เป็นพื้นที่หลักและศูนย์กลางในการบริหาร และการจัด
                            การเรียนการสอนของมหาวิทยาลัย
                            <br>
                             <a
                                rel="nofollow" href="https://templatemo.com/contact" target="_parent">contact</a> page
                            for more detail.</p>
                        <ul class="social">
                            <li><a href="https://fb.com/templatemo"><i class="fa fa-facebook"></i></a></li>
                           <!--  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-footer">
                        <p>Copyright &copy; 2020 KMUTT Active Recruitment

                        | Designed by <a rel="nofollow" href="https://templatemo.com">TemplateMo</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="/js/popper.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="/js/owl-carousel.js"></script>
    <script src="/js/scrollreveal.min.js"></script>
    <script src="/js/waypoints.min.js"></script>
    <script src="/js/jquery.counterup.min.js"></script>
    <script src="/js/imgfix.min.js"></script>

    <!-- Global Init -->
    <script src="/js/custom.js"></script>

</body>
</html>