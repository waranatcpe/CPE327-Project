@extends('layouts.app')
@section('title', 'Home')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">โครงการที่เปิดรับสมัคร</h6>
    </div>
    <div class="card-body">
        <p><b>สวัสดี,</b>  {{ Auth::user()->name }}</p>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                <table id="recruitTable" class="table table-hover">
                  <thead>
                    <tr>
                        <!-- <td>ที่</td> -->
                        <td>AR-Round</td>
                        <td>รหัสการสมัคร</td>
                        <td>คณะ</td>
                        <td>ภาควิชา</td>
                        <td>ปิดรับสมัคร</td>
                        <td>สถานะ</td>
                        <td>สมัคร</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($recruitData as $data)
                    <tr>
                        <td>{{$data->AR_ROUND}}</td>
                        <td>#AR{{date('y') + 43}}00{{$data->id}}</td>
                        <td>{{$data->faculty}}</td>
                        <td>{{$data->department}}</td>
                        <td>{{$data->closeDate}}</td>
                        <td>
                          @if($data->publish)
                            <font color="green">Published</font>
                          @else
                            <font color="red">Close</font>
                          @endif
                        </td>
                        <td>
                          <button class="btn btn-sm btn-dark">สมัคร</button>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>    
                </div>

            </div>          
            <!-- <div class="col-md-2">
                <h3>ข้อมูลการสมัคร</h3>
            </div> -->
        </div>
        
    </div>
</div>
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
