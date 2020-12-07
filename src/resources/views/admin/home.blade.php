@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">Admission Zone</h2>
    </div>
    <div class="card-body">
        <p><b>ผู้ใช้งาน ::</b>  {{ Auth::user()->name }}</p>
       <div class="row">
           <div class="col-md-3">
               <div class="card text-white bg-gradient-primary mb-3" >
                  <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-folder-plus"></i> สร้างการรับสมัคร</h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        การรับสมัครแต่สาขา และเกณฑ์การรับสมัคร
                    </p>
                    <div class="text-right">
                        <a href="/admin/create" class="btn btn-dark">สร้าง</a>
                    </div>
                     
                  </div>
                </div>
           </div>

           <div class="col-md-3">
               <div class="card text-white bg-gradient-primary mb-3" >
                  <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-database"></i> สาขาที่เปิดรับสมัคร</h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        ข้อมูลการเปิดรับสมัครแต่ละสาขา
                    </p>
                    <div class="text-right">
                        <a href="/admin/view" class="btn btn-dark">ดูข้อมูล</a>
                    </div>
                     
                  </div>
                </div>
           </div>

           <div class="col-md-3">
               <div class="card text-white bg-gradient-primary mb-3" >
                  <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-users"></i> ข้อมูลผู้สมัคร</h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        ข้อมูลผู้สมัครในแต่ละสาขา
                    </p>
                    <div class="text-right">
                        <a href="/admin/result" class="btn btn-dark">ดูข้อมูล</a>
                    </div>
                     
                  </div>
                </div>
           </div>               
       </div>        
    </div>
<!-- </div> -->

<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">สาขาที่เปิดรับสมัคร</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                <table id="recruitTable" class="table table-hover">
                  <thead>
                    <tr>
                        <!-- <td>ที่</td> -->
                        <th>TCAS</th>
                        <th>รหัสการสมัคร</th>
                        <th>คณะ</th>
                        <!-- <th>ภาควิชา</th> -->
                        <th>สาขา</th>
                        <th>ปิดรับสมัคร</th>
                        <th>สถานะ</th>
                        <!-- <th>จัดการ</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($recruitData as $data)
                    <tr>
                        <!-- <td></td> -->
                        <td>{{$data->TCAS_ROUND}}</td>
                        <td>#AR{{date('y') + 43}}00{{$data->id}}</td>
                        <td>{{$data->facName}}</td>
                        <!-- <td>{{$data->department}}</td> -->
                        <td>{{$data->deptName}}</td>
                        <td>{{$data->closeDate}}</td>
                        <td>
                          @if($data->publish)
                            <font color="green">Published</font>
                          @else
                            <font color="red">Closed</font>
                          @endif
                        </td>
                       <!--  <td>
                          <button class="btn btn-sm btn-dark"><i class="fa fa-edit"></i></button>
                          <button class="btn btn-sm btn-dark"><i class="fa fa-times"></i></button>
                        </td> -->
                    </tr>
                    @endforeach
                  </tbody>
                </table>    
                </div>

            </div>          
        </div>
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
