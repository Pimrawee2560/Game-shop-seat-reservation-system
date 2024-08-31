<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยืนยันการจอง</title>
    <style>
        .confirmation-message-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: 0 auto;
            margin-top: 300px;
            text-align: center;
        }
        .confirmation-message {
            margin-top: 20px;
            color: black;
        }
        .error-message {
            color: white;
            background-color: #FF69B4;
            padding: 5px 5px;
            border-radius: 10px;
            text-decoration: none;
        }
    </style>
</head>
<body style="background-color: #FFB6C1;">
<?php
//เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล
require_once 'condb.php';

//print_r($_POST);

if (isset($_POST['table_id']) && isset($_POST['booking_name']) && isset($_POST['booking_date'])) {
	

//ประกาศตัวแปรรับค่าจากฟอร์ม

$booking_name = $_POST['booking_name'];
$booking_date = $_POST['booking_date'];
$booking_time = $_POST['booking_time'];
$booking_phone = $_POST['booking_phone'];
$table_id = $_POST['table_id'];
$dateCreate = date('Y-m-d H:i:s'); //วันที่บันทึก

//insert booking
mysqli_query($condb, "BEGIN");
$sqlInsertBooking	= "INSERT INTO  tbl_booking values(null, '$table_id', '$booking_name', '$booking_date', '$booking_time', '$booking_phone','$dateCreate')";
$rsInsertBooking	= mysqli_query($condb, $sqlInsertBooking);
 
//การใช้ Transection ประกอบด้วย  BEGIN COMMIT ROLLBACK 


//update table status
$sqlUpdate ="UPDATE tbl_table SET table_status=1 WHERE id = $table_id"; //1=จอง
$rsUpdate = mysqli_query($condb, $sqlUpdate);


if($rsInsertBooking && $rsUpdate){ //ตรรวจสอบถ้า 2 ตัวแปรทำงานได้ถูกต้องจะทำการบันทึก แต่ถ้าเกิดข้อผิดพลาดจะ Rollback คือไม่บันทึกข้อมูลใดๆ
		mysqli_query($condb, "COMMIT");
		echo '<div class="confirmation-message-container">
		<div class="confirmation-message">
			บันทึกข้อมูลการจองเรียบร้อยแล้วกรุณาชำระเงินและอัพโหลดสลิปการจอง<br><br> 
			<a href="upload.php" style="text-decoration: none; color: white; background-color: #FF69B4; padding: 5px 5px; border-radius: 10px;">ชำระเงิน</a>
		</div>
	  </div>'; 
	}else{
		mmysqli_query($condb, "ROLLBACK");  
        $msg = '<div class="error-message">
                    บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ  
                </div>
                <a href="booking.php" class="error-message">กลับหน้าหลัก</a>';  
        echo '<div style="text-align: center; margin-top: 350px;">' . $msg . '</div>'; 
	}
} //iset 
else{
	header("Location: index.php");	
}
//ลองเอาไปประยุกต์ใช้ดูครับ devbanban.com
?>
</body>
</html>