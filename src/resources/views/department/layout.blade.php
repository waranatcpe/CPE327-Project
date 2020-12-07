<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>ลิมิตของฟังก์ชัน - แคลคูลัสเบื้องต้น</title>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
		<style type="text/css">
			body{
				font-family: 'Kanit', sans-serif;
			}
		</style>
	</head>
	<body>
		<!-- Fixed navbar -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="?page=home">AR KMUTT</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="/home">หน้าแรก</a></li>
						<li><a href="/project">เปิดรับสมัคร</a></li>
						<li><a class="nav-link collapsed" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-fw fa-sign-out-alt"></i>
                                <span>ออกจากระบบ</span>
                            </a></li>
					</ul>
					</div>
				</div>
			</nav>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
			<div class="container theme-showcase" role="main">
				<div class="jumbotron"><br>
					<h1>Active Recruitment</h1>
					<p>มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี </p>
				</div>
				<div class="page-header">
					<h1>@yield('title')</h1>
				</div>

				@yield('content')
			</div>
			
			<!-- Bootstrap core JavaScript -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		</body>
	</html>