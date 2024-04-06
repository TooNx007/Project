<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alumni_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// ตรวจสอบว่ามีการส่งค่าค้นหาเข้ามาหรือไม่
if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM ชื่อตาราง WHERE ชื่อ LIKE '%$search%' OR นามสกุล LIKE '%$search%' OR รหัสนักศึกษา LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // แสดงข้อมูลที่ดึงออกมา
        while($row = mysqli_fetch_assoc($result)) {
            echo "ชื่อ: " . $row["ชื่อ"]. " - นามสกุล: " . $row["นามสกุล"]. " - รหัสนักศึกษา: " . $row["รหัสนักศึกษา"]. "<br>";
        }
    } else {
        echo "ไม่พบผลลัพธ์";
    }
}

// ปิดการเชื่อมต่อ MySQL database
//mysqli_close($conn);
?>

