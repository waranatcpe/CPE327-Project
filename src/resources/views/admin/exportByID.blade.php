@php
  $date = date('y') + 43;
  header("Content-Type: application/vnd.ms-excel");
  header('Content-Disposition: attachment; filename="'.'#AR'.$date.'00'.$recruit->id.'-'.$recruit->facName."-".$recruit->deptName.'.xls"');
  header("Content-Type: application/force-download"); 
  header("Content-Type: application/octet-stream"); 
  header("Content-Type: application/download"); 
  header("Content-Transfer-Encoding: binary"); 
    @readfile($filename);  
@endphp

<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
  html,body{
    font-family: 'Sarabun', sans-serif;
  }
</style>
</head>
<body>
    @if($applyCount > 0)
      <table border="1" width="130%">
          <!-- <tr bgcolor="#F5F5F5">
            <td colspan="18" align="center">
              <p style="color: #ec6b26;"><font size='4'><b>ข้อมูลผู้สมัคร</b></font><br>
              <b>{{$recruit->facName}} / {{$recruit->department}}</b></p>
              {{$recruit->deptName}} :: TCAS {{$recruit->TCAS_ROUND}} :: {{$recruit->name_round}}
            </td>
          </tr> -->
          <tr bgcolor="#F5F5F5">
            <td align="center" colspan="3">
              <b style="color: #ec6b26;">เกณฑ์การรับสมัคร</b>
            </td>
            <td align="center" rowspan="8" valign="middle" colspan="13">
              
              <p style="color: #ec6b26;"><font size='4'><b>ข้อมูลผู้สมัคร</b></font><br>
              <b>{{$recruit->facName}} / {{$recruit->department}}</b></p>
              <b>{{$recruit->name_round}} ปีการศึกษา 2564</b><br>
              <!-- <br><b>จำนวนที่รับ : </b>{{$recruit->amount}} คน<br> --><br>
              วันที่เปิดรับสมัคร : {{$recruit->openDate}} ถึง {{$recruit->closeDate}}
              <!-- <b>วันที่ปิด : </b>{{$recruit->closeDate}}<br> -->
              <!-- <b>เอกสารเพิ่มเติม : </b>{{$recruit->link}} -->

            </td>
            <!-- <td colspan="6" rowspan="8"></td> -->
          </tr>
          <tr bgcolor="#F5F5F5">
            <td colspan="2">เกรดเฉลี่ยรวม</td>
            <td align="center" colspan="1"><b>{{$recruit->GPAX}}</b></td>
          </tr>
          <tr bgcolor="#F5F5F5">
            <td colspan="2">GPA คณิตศาสตร์</td>
            <td align="center" colspan="1"><b>{{$recruit->GPA_MTH}}</b></td>
          </tr>
          <tr bgcolor="#F5F5F5">
            <td colspan="2">GPA วิทยาศาสตร์</td>
            <td align="center" colspan="1"><b>{{$recruit->GPA_SCI}}</b></td>
          </tr>
          <tr bgcolor="#F5F5F5">
            <td colspan="2">GPA ภาษาต่างประเทศ</td>
            <td align="center" colspan="1"><b>{{$recruit->GPA_ENG}}</b></td>
          </tr>
          <tr bgcolor="#F5F5F5">
            <td colspan="2">หน่วยกิตคณิตศาสตร์</td>
            <td align="center" colspan="1"><b>{{$recruit->CRE_MTH}}</b></td>
          </tr>
          <tr bgcolor="#F5F5F5">
            <td colspan="2">หน่วยกิตวิทยาศาสตร์</td>
            <td align="center" colspan="1"><b>{{$recruit->CRE_SCI}}</b></td>
          </tr>
          <tr bgcolor="#F5F5F5">
            <td colspan="2">หน่วยกิตภาษาต่างประเทศ</td>
            <td align="center" colspan="1"><b>{{$recruit->CRE_ENG}}</b></td>
          </tr>
          
          <tr  bgcolor="#FFEBCD">
            <th colspan="7"><center>ข้อมูลส่วนตัว</center></th>
            <th colspan="4"><center>เกรดเฉลี่ย</center></th>
            <th colspan="3"><center>หน่วยกิตตามกลุ่มสาระการเรียนรู้</center></th>
            <th colspan="6"><center>ข้อมูลเอกสาร/อื่นๆ</center></th>
          </tr>
          <tr  bgcolor="#F5F5F5">
            <td align="center"><b>ที่</b></td>
            <td align="center" width="160"><b>ชื่อ-นามสกุล</b></td>
            <td align="center" width="100"><b>โทรศัพท์</b></td>
            <td align="center" width="220"><b>อีเมล</b></td>
            <td align="center"><b>Facebook</b></td>
            <td align="center"><b>LineID</b></td>
            <td align="center" width="150"><b>วุฒิที่ใช้สมัคร</b></td>
            <td align="center"><b>GPAX</b><!-- <br>{{$recruit->GPAX}} --></td>
            <td align="center"><b>GPA คณิตศาสตร์</b><!-- <br>{{number_format($recruit->GPA_MTH,2)}} --></td>
            <td align="center"><b>GPA วิทยาศาสตร์</b><!-- <br>{{number_format($recruit->GPA_SCI,2)}} --></td>
            <td align="center"><b>GPA ภาษาต่างประเทศ</b><!-- <br>{{number_format($recruit->GPA_ENG,2)}} --></td>
            <td align="center"><b>คณิตศาสตร์</b><!-- <br>{{number_format($recruit->CRE_MTH,2)}} หน่วยกิต --></td>
            <td align="center"><b>วิทยาศาสตร์</b><!-- <br>{{number_format($recruit->CRE_SCI,2)}} หน่วยกิต --></td>
            <td align="center"><b>ภาษาต่างประเทศ</b><!-- <br>{{number_format($recruit->CRE_ENG,2)}} หน่วยกิต --></td>
            <td align="center"><b>คะแนนภาษาอังกฤษ</b><!-- <br>(@if($recruit->ENG_TEST) / @else x @endif) --></td>
            <td align="center"><b>Portfolio</b></td>
            <td align="center"><b>Statement of Purpose</b></td>
            <!-- <td align="center"><b>หนังสือรับรองจากสมาคมศิษย์เก่า</b></td> -->
            <td align="center"><b>ลิงก์อื่น ๆ ประกอบการสมัคร</b></td>
            <td align="center"><b>สำเนาผลการเรียน (ปพ.1)</b></td>
            
          </tr>
          @php $i=1; @endphp
          @foreach($applyData as $app)
            <tr>
            <td align="center">{{$i++}}</td>
            <td>{{$app->firstname." ".$app->lastname}}</td>
            <td><?php echo "=\"$app->telephone\"";?></td>
            <td>{{$app->email}}</td>
            <td>{{$app->facebook}}</td>
            <td>{{$app->lineID}}</td>
            <td>{{$app->edu_type}}</td>
            <td>@if($app->GPAX >= $recruit->GPAX) <font color="green">{{$app->GPAX}}</font> @else <font color="red">{{$app->GPAX}}</font>@endif</td>
            <td>@if($app->GPA_MTH >= $recruit->GPA_MTH) <font color="green">{{$app->GPA_MTH}}</font> @else <font color="red">{{$app->GPA_MTH}}</font> @endif</td>
            <td>@if($app->GPA_SCI >= $recruit->GPA_SCI) <font color="green">{{$app->GPA_SCI}}</font> @else <font color="red">{{$app->GPA_SCI}}</font> @endif</td>
            <td>@if($app->GPA_ENG >= $recruit->GPA_ENG)<font color="green">{{$app->GPA_ENG}}</font> @else <font color="red">{{$app->GPA_ENG}}</font>  @endif</td>
            <td>@if($app->CRE_MTH >= $recruit->CRE_MTH)<font color="green">{{$app->CRE_MTH}}</font> @else <font color="red">{{$app->GPA_MTH}}</font>  @endif</td>
            <td>@if($app->CRE_SCI >= $recruit->CRE_SCI)<font color="green">{{$app->CRE_SCI}}</font> @else <font color="red">{{$app->CRE_SCI}}</font>  @endif</td>
            <td>@if($app->CRE_ENG >= $recruit->CRE_ENG)<font color="green">{{$app->CRE_ENG}}</font> @else <font color="red">{{$app->CRE_ENG}}</font> @endif</td>
            <td><small>
              @if($recruit->ENG_TEST) 
                @if($app->IELTS != NULL || $app->TOEFL != NULL || $app->TOEIC != NULL || $app->CUTEP != NULL)
                   IELTS: {{$app->IELTS}}<br>TOEFL: {{$app->TOEFL}}<br>TOEIC: {{$app->TOEIC}}<br>CU-TEP: {{$app->CUTEP}}<br>RMIT: {{$app->RMIT}}
                @else
                    ไม่มี
                @endif
              @else - @endif
              
            </small></td>
            <td>
              {{env('BASE_PORT_STORAGE')}}/{{$app->portfolio}}
            </td>
            <td>
              @if($app->sop == NULL)
                -
              @else
                {{env('BASE_SOP_STORAGE')}}/{{$app->sop}}
              @endif
            </td>
            
            <td>
              @if($app->link == NULL)
                -
              @else
                {{$app->link}}
              @endif
            </td>
            <td>
              {{env('BASE_FILE_STORAGE')}}/{{$app->transcript}}
            </td>
            
          </tr>
          @endforeach
      </table>
      <br><br>
   รายงานจาก Active Recruitment Registration System
  <br>รายงานเมื่อ : <?php echo date('d-m-Y')." | ".date('H:i:s');?>
    @else
    <center>
      <h5>ไม่มีข้อมูลผู้สมัคร</h5>
    </center>
    @endif
     </div>
</div>

</body>
</html>