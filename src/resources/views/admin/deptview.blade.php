@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">สาขาที่เปิดรับสมัคร</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                <table id="deptTable" class="table table-hover">
                  <thead>
                    <tr>
                        <!-- <td>ที่</td> -->
                        <th>TCAS</th>
                        <th>ชื่อรอบ</th>
                        <!-- <th>รหัสการสมัคร</th> -->
                        <th>คณะ</th>
                        <!-- <th>ภาควิชา</th> -->
                        <th>สาขา</th>
                        <!-- <th>ปิดรับสมัคร</th> -->
                        <th>สถานะการประกาศ</th>
                        <!-- <th>สถานะ</th> -->
                        <th>จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($recruitData as $data)
                    <tr>
                        <!-- <td></td> -->
                        <td>{{$data->TCAS_ROUND}}</td>
                        <td>{{$data->name_round}}</td>
                        <!-- <td>#AR{{date('y') + 43}}00{{$data->id}}</td> -->
                        <td>{{$data->facName}}</td>
                        <!-- <td>{{$data->department}}</td> -->
                        <td>{{$data->deptName}}</td>
                        <td><div class="badge @if($data->interview_location == NULL) badge-danger @else badge-success @endif">@if($data->interview_location == NULL) ยังไม่ได้ประกาศ @else ประกาศแล้ว @endif
                        </div></td>
                        <!-- <td>{{$data->closeDate}}</td> -->
                        <!-- <td>
                          @if($data->publish)
                            <font color="green">Published</font>
                          @else
                            <font color="red">Closed</font>
                          @endif
                        </td> -->
                        <td>
                          <button onclick="edit({{$data->id}})" class="btn btn-sm btn-dark"><i class="fa fa-edit"></i></button>
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
  $("#deptTable").DataTable()

  var edit = (id)=>{
    window.location = '/dept/edit/'+id
  }
</script>

@endsection
