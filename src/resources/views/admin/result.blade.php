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
                <table id="recruitTable" class="table table-hover">
                  <thead>
                    <tr>
                        <!-- <td>ที่</td> -->
                        <th width="8%">TCAS</th>
                        <th width="15%">ชื่อรอบ</th>
                        <th>รหัสการสมัคร</th>
                        <th>คณะ</th>
                        <!-- <th>ภาควิชา</th> -->
                        <th>สาขา</th>
                        <!-- <th>ปิดรับสมัคร</th> -->
                        <th>ผู้สมัคร</th>
                        <th>สถานะ</th>
                        <th width="10%">จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($recruitData as $data)
                    <tr>
                        <td>{{$data->TCAS_ROUND}}</td>
                        <td>{{$data->name_round}}</td>
                        <td>#AR{{date('y') + 43}}00{{$data->id}}</td>
                        <td>{{$data->facName}}</td>
                        <td>{{$data->deptName}}</td>
                        <td align="center"> 
                          {{ App\Apply::where('recruitment_id', $data->id)->count() }}
                        </td>
                        <td>
                          @if($data->publish)
                            <font color="green">Published</font>
                          @else
                            <font color="red">Closed</font>
                          @endif
                        </td>
                        <td>
                          @if(Auth::user()->type == 2)
                          @if($_SERVER['REQUEST_URI'] == "/dept/final")
                           <a href="/dept/final/{{$data->id}}">
                          @else
                           <a href="/dept/active/{{$data->id}}">
                          @endif
                         
                          @else
                          <a href="/admin/active/{{$data->id}}">
                          @endif

                          @if($_SERVER['REQUEST_URI'] == "/dept/final")
                          <button class="btn btn-primary btn-block">ประกาศผลสอบคัดเลือก</button>
                          @else
                          <button class="btn btn-primary btn-block">ดูผู้สมัคร</button>
                          @endif
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
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/fc-3.3.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/fc-3.3.1/datatables.min.js"></script>

<script type="text/javascript">
  $("#recruitTable").DataTable({
     scrollX:        true,
    scrollCollapse: true,
    // paging:         false,
    fixedColumns:   {
        leftColumns: 0,
        rightColumns: 1
    }
  })
</script>


@endsection
