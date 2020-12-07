@extends('layouts.app')
@section('title', 'บันทึกประวัติ')

@section('content')
<!-- <div class="card shadow mb-4"> -->
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">บันทึกประวัติ</h2>
    </div>
    <div class="card-body">
        <!-- <p><b>หมายเลขบัตรประชาชน ::</b>  {{ Auth::user()->username }}</p> -->
        @if($edit)
       <div class="row">
           <div class="col-md-4">
               <div class="card text-white bg-gradient-primary mb-3" >
                  <div class="card-body">
                    <h5 class="card-title">ประวัติส่วนตัว</h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        ข้อมูลส่วนตัวในการสมัคร
                    </p>
                    <div class="text-right">
                        <a href="/profile/myprofile" class="btn btn-dark">บันทึก</a>
                    </div>
                     
                  </div>
                  <div class="card-footer text-muted text-center">
                    สถานะ : 
                    @if($status['profile'])
                      <font color="green">บันทึกครบแล้ว</font>
                    @else
                      <font color="red">ยังบันทึกไม่ครบ</font>
                    @endif
                  </div>
                </div>
           </div>

           <div class="col-md-4">
               <div class="card text-white bg-gradient-primary mb-3" >
                  <div class="card-body">
                    <h5 class="card-title">ข้อมูลการศึกษา</h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        ผลการเรียน, หน่วยกิต, ผลการทดสอบอื่น ๆ 
                    </p>
                    <div class="text-right">
                        <a href="/profile/education" class="btn btn-dark">บันทึก</a>
                    </div>
                     
                  </div>
                  <div class="card-footer text-muted text-center">
                    สถานะ : 
                    @if($status['education'])
                      <font color="green">บันทึกครบแล้ว</font>
                    @else
                      <font color="red">ยังบันทึกไม่ครบ</font>
                    @endif
                  </div>
                </div>
           </div>

           <div class="col-md-4">
               <div class="card text-white bg-gradient-primary mb-3" >
                  <div class="card-body">
                    <h5 class="card-title">สำเนาผลการเรียน</h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        ปพ.1 และเอกสารต่าง ๆ
                    </p>
                    <div class="text-right">
                        <a href="/profile/transcript" class="btn btn-dark">บันทึก</a>
                    </div>
                     
                  </div>
                  <div class="card-footer text-muted text-center">
                    สถานะ : 
                    @if($status['transcript'])
                      <font color="green">อัพโหลดแล้ว</font>
                    @else
                      <font color="red">ยังไม่ได้อัพโหลด</font>
                    @endif
                  </div>
                </div>
           </div>
       </div>  
       @else


       <!-- Disallow Edit -->
       <div class="alert alert-warning">
         คุณยื่นใบสมัครไปแล้ว ไม่สามารถแก้ไขข้อมูลได้
       </div>
       <div class="row">
           <div class="col-md-4">
               <div class="card text-white bg-gradient-dark mb-3" >
                  <div class="card-body">
                    <h5 class="card-title">ประวัติส่วนตัว</h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        ข้อมูลส่วนตัวในการสมัคร
                    </p>
                    <div class="text-right">
                        <button disabled class="btn btn-dark">บันทึก</button>
                    </div>
                     
                  </div>
                  <div class="card-footer text-muted text-center">
                    สถานะ : 
                    @if($status['profile'])
                      <font color="green">บันทึกครบแล้ว</font>
                    @else
                      <font color="red">ยังบันทึกไม่ครบ</font>
                    @endif
                  </div>
                </div>
           </div>

           <div class="col-md-4">
               <div class="card text-white bg-gradient-dark mb-3" >
                  <div class="card-body">
                    <h5 class="card-title">ข้อมูลการศึกษา</h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        ผลการเรียน, หน่วยกิต, ผลการทดสอบอื่น ๆ 
                    </p>
                    <div class="text-right">
                           <button disabled class="btn btn-dark">บันทึก</button>
                    </div>
                     
                  </div>
                  <div class="card-footer text-muted text-center">
                    สถานะ : 
                    @if($status['education'])
                      <font color="green">บันทึกครบแล้ว</font>
                    @else
                      <font color="red">ยังบันทึกไม่ครบ</font>
                    @endif
                  </div>
                </div>
           </div>

           <div class="col-md-4">
               <div class="card text-white bg-gradient-dark mb-3" >
                  <div class="card-body">
                    <h5 class="card-title">สำเนาผลการเรียน</h5>
                    <p class="card-text" style="line-height: 1.5rem;">
                        ปพ.1 และเอกสารต่าง ๆ
                    </p>
                    <div class="text-right">
                           <button disabled class="btn btn-dark">บันทึก</button>
                    </div>
                     
                  </div>
                  <div class="card-footer text-muted text-center">
                    สถานะ : 
                    @if($status['transcript'])
                      <font color="green">อัพโหลดแล้ว</font>
                    @else
                      <font color="red">ยังไม่ได้อัพโหลด</font>
                    @endif
                  </div>
                </div>
           </div>
       </div> 


       @endif


    </div>
<!-- </div> -->




<!-- <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">สรุปข้อมูลใบสมัคร</h6>
    </div>
    <div class="card-body">

    </div>
</div> -->
@endsection
