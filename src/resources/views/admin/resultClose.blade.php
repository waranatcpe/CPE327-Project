@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">สาขาที่ปิดรับสมัครไปแล้ว</h2>
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
                        <th>ชื่อรอบ</th>
                        <th>รหัสการสมัคร</th>
                        <th>คณะ</th>
                        <!-- <th>ภาควิชา</th> -->
                        <th>สาขา</th>
                        <th>ปิดรับสมัคร</th>
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($recruitData as $data)
                    <tr>
                        <!-- <td></td> -->
                        <td>{{$data->TCAS_ROUND}}</td>
                        <th>{{$data->name_round}}</th>
                        <td>#AR{{date('y') + 43}}00{{$data->id}}</td>
                        <td>{{$data->facName}}</td>
                        <!-- <td>{{$data->department}}</td> -->
                        <td>{{$data->deptName}}</td>
                        <td>{{$data->closeDate}}</td>
                        <td>
                        

                            <font color="red">Closed</font>
                        
                        </td>
                        <td>
                          <a href="/admin/active/{{$data->id}}">
                          <button class="btn btn-primary btn-block">ดูผู้สมัคร</button>
                          </a>
                        </td>
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
