<!DOCTYPE html>
<html>

<head>
    <title>รายการข่าวสาร</title>
    <script>
        function confirmDelete() {
            return confirm("คุณต้องการลบข่าวสารนี้?");
        }
    </script>
</head>

<body>
    <h1>รายการข่าวสาร</h1>
    <table border='1'>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image_url</th>
            <th>Action</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "alumni_db";

        // สร้างการเชื่อมต่อกับฐานข้อมูล
        $conn = new mysqli($servername, $username, $password, $dbname);

        // ตรวจสอบการเชื่อมต่อ
        if ($conn->connect_error) {
            die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
        }

        // สร้างคำสั่ง SQL สำหรับดึงข้อมูลข่าวสาร
        $sql = "SELECT * FROM news";
        $result = $conn->query($sql);

        // ตรวจสอบว่ามีข้อมูลในตารางหรือไม่
        if ($result->num_rows > 0) {
            // แสดงข้อมูลข่าวสารทั้งหมดในรูปแบบตาราง
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . (strlen($row["title"]) > 100 ? substr($row["title"], 0, 200) : $row["title"]) . "</td>";
                echo "<td>" . (strlen($row["content"]) > 100 ? substr($row["content"], 0, 600) : $row["content"]) . "</td>";
                echo "<td>" . $row["image_url"] . "</td>";
                echo "<td><form method='post' action='delete_news.php' onsubmit='return confirmDelete();'><input type='hidden' name='news_id' value='" . $row["id"] . "'><input type='submit' name='delete_news' value='Delete'></form></td>";
                echo "</tr>";
            }

           
        }

        // ปิดการเชื่อมต่อกับฐานข้อมูล
        $conn->close();
        ?>
    </table>
</body>

</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alumni_db";

// สร้างการเชื่อมต่อกับฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// เรียกใช้งานตัวแปร POST ที่ส่งมาจากฟอร์ม
if (isset($_POST['delete_news'])) {
    $news_id = $_POST['news_id'];

    // สร้างคำสั่ง SQL สำหรับลบข่าวสาร
    $sql = "DELETE FROM news WHERE id = $news_id";

    // ทำการ execute คำสั่ง SQL
    if ($conn->query($sql) === TRUE) {
        // ไม่แสดงข้อความ "ลบข่าวสารเรียบร้อยแล้ว"
    } else {
        echo "เกิดข้อผิดพลาดในการลบข่าวสาร: " . $conn->error;
    }
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>