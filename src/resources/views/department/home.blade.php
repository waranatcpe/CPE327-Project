@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">Department Zone</h2>
    </div>
    <div class="card-body">
        <p><b>Welcome ::</b>  {{ "[ ".Auth::user()->username." ] ".Auth::user()->name." ".Auth::user()->lastname }}</p>
        <div class="col-md-3">
               <div class="card text-white bg-gradient-primary mb-3" >
                  <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-search"></i> ดูข้อมูลผู้สมัคร</h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        สาขาวิชาที่กำลังเปิดรับสมัคร
                    </p>
                    <div class="text-right">
                        <a href="/dept/result" class="btn btn-dark"><i class="fa fa-eye"></i> ดูข้อมูล</a>
                    </div>
                     
                  </div>
                </div>
           </div>
<hr>
      <div style="padding-left: 20px;">
        <h5 style="color: #fff; background-color: #ec6b26; width: 230px; height: auto; padding: 10px 0px 10px 20px; border-radius: 10px;"><i class="fa fa-bars"></i> สาขาวิชาของฉัน</h5>
      </div>
        <div style="line-height: 1.5rem; padding-left: 40px;">
          @foreach($depts as $d)
            <li> {{$d->name}}</li>
          @endforeach
        </div>
        
        
     <!--  <a href="/dept/result">
      <button class="btn btn-lg btn-primary">ดูข้อมูลการรับสมัคร</button>
      </a> -->
    </div>

<!-- </div> -->

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $("#recruitTable").DataTable()
</script>

@endsection
