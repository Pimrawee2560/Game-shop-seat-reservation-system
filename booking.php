<?php
//เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล
require_once 'condb.php';
//query
$query = "SELECT * FROM tbl_table WHERE id=$_GET[id]";
$result = mysqli_query($condb, $query);
$row = mysqli_fetch_array($result);
//print_r($row);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>แสดงข้อมูลโต๊ะเพื่อทำการจอง</title>
    <style type="text/css">
    .devbanban{
    background-color: #FFFFFF;
    }
    </style>
  </head>
  <body style="background-color: #FFB6C1;">
    <div class="container">
      <div class="row">
        <div class="col-sm-2 col-md-2"></div>
        <div class="col-12 col-sm-11 col-md-7 devbanban " style="margin-left:60px; margin-top: 100px; border-radius: 10px; ">
          <br>
          <h4 align="center" style="color: #000000; font-family: 'Comic Sans MS', Empty table; font-size: 200%;">Empty Table</h4>
          <br>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="alert" role="alert" style="background-color:  #FFB6C1">
                <center style="color: white; background-color: #FFB6C1; font-family: Comic Sans MS'"> <b> บันทึกการเลือกโต๊ะ เลือกและจองวันต่อวัน </b></font> </center>
              </div>
              <hr>
                <div style="margin-left: 20px;">
                  <form action="save_booking.php" method="post">
                    <div class="form-group row">
                      <label class="col-sm-2 ">เลขโต๊ะ</label>
                      <div class="col-sm-4">
                        <input type="text" name="table_name" class="form-control" disabled value="<?php echo $row['table_name'];?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 ">ผู้จอง</label>
                      <div class="col-sm-7">
                        <input type="text" name="booking_name" class="form-control" required placeholder="ชื่อผู้จอง" minlength="5">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 ">วันที่</label>
                      <div class="col-sm-5">
                        <input type="date" name="booking_date" class="form-control" required value="<?php echo date('Y-m-d');?>" min="<?php echo date('Y-m-d');?>" max="<?php echo date('Y-m-d');?>">
                      </div>
                      <label class="col-sm-1 ">เวลา</label>
                      <div class="col-sm-3">
                        <input type="time" name="booking_time" class="form-control" required placeholder="เวลา">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 ">เบอร์โทร</label>
                      <div class="col-sm-7">
                        <input type="text" name="booking_phone" class="form-control" required placeholder="เบอร์โทร" minlength="10" maxlength="10">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 "></label>
                      <div class="col-sm-10">
                        <input type="hidden" name="table_id" value="<?php echo $_GET['id'];?>">
                       <button type="submit" class="btn btn-success" style="background-color: #FFB6C1;border-color: #FFB6C1;">Submit</button>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </body>
    </html>
    