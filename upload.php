<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <title>อัพโหลดสลิป</title>
        <!-- sweet alert  -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        <style>
        .container {
            display: flex;
            height: 90vh;
            justify-content: center;
            align-items: center;
            margin-left: 15px;
        }
        .border.p-3 {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            width: 500px; /* ปรับความกว้างของกรอบตามที่ต้องการ */
    }
</style>
    </head>
    <body style="background-color: #FFB6C1;" class="text-center d-flex align-items-center">
         <div class="container">
                <div class="row justify-content-center">
                <div class="col-md-7"> <br> <br>
                <div class="border p-3">
                    <h3 style="text-decoration: none; color: white; background-color: #FFB6C1; padding: 5px 5px; border-radius: 10px;">อัพโหลดรูปสลิปการชำระเงิน</h3> <br> 
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="text" name="img_name" required class="form-control" placeholder="ชื่อผู้จองโต๊ะคอมหรือผู้ชำระเงิน"> <br>
                         <font color="red">ชั่วโมงละ 15 บาท*อัพโหลดได้เฉพาะ .jpeg , .jpg , .png </font>
                        <input type="file" name="img_file" required   class="form-control" accept="image/jpeg, image/png, image/jpg"> <br>
                        <button type="submit" class="btn btn-primary" style="background-color: #FFB6C1;border-color: #FFB6C1;" >Upload</button>
                    </form>
                        <tbody>
                            <?php
                            //คิวรี่ข้อมูลมาแสดงในตาราง
                            require_once 'connect.php';
                            $stmt = $conn->prepare("SELECT* FROM tbl_uploads");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach($result as $k) {
                            ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br>
                    <center>อัพโหลดสลิปแล้วแคปหน้าจอแล้วนำไปส่งที่หน้าเค้าเตอร้าน</center>
                </div>
            </div>
        </div>
    </body>
</html>

<?php 

if (isset($_POST['img_name'])) {
    require_once 'connect.php';
     //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $img_file = (isset($_POST['img_file']) ? $_POST['img_file'] : '');
    $upload=$_FILES['img_file']['name'];

    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['img_file']['name'],".");

    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
    if($typefile =='.jpg' || $typefile  =='.jpeg' || $typefile  =='.png'){

    //โฟลเดอร์ที่เก็บไฟล์
    $path="upload/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = $numrand.$date1.$typefile;
    $path_copy=$path.$newname;
    //คัดลอกไฟล์ไปยังโฟลเดอร์
    move_uploaded_file($_FILES['img_file']['tmp_name'],$path_copy); 

     //ประกาศตัวแปรรับค่าจากฟอร์ม
    $img_name = $_POST['img_name'];
    
    //sql insert
    $stmt = $conn->prepare("INSERT INTO tbl_uploads (img_name, img_file)
    VALUES (:img_name, '$newname')");
    $stmt->bindParam(':img_name', $img_name, PDO::PARAM_STR);
    $result = $stmt->execute();
    //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
            if($result){
                echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "อัพโหลดภาพสำเร็จ",
                          type: "success"
                      }, function() {
                          window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
            }else{
               echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เกิดข้อผิดพลาด",
                          type: "error"
                      }, function() {
                          window.location = "upload.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
            } //else ของ if result

        
        }else{ //ถ้าไฟล์ที่อัพโหลดไม่ตรงตามที่กำหนด
            echo '<script>
                         setTimeout(function() {
                          swal({
                              title: "คุณอัพโหลดไฟล์ไม่ถูกต้อง",
                              type: "error"
                          }, function() {
                              window.location = "upload.php"; //หน้าที่ต้องการให้กระโดดไป
                          });
                        }, 1000);
                    </script>';
        } //else ของเช็คนามสกุลไฟล์
   
    } // if($upload !='') {

    $conn = null; //close connect db
    } //isset
?>