<!DOCTYPE html>
<html>

<head>
    <title>ลบข่าวสาร</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .delete-news {
            margin-top: 20px;
        }

        .delete-news form {
            display: inline-block;
        }

        .delete-news input[type="submit"] {
            padding: 5px 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #f0f0f0;
            color: red;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-news input[type="submit"]:hover {
            background-color: #e0e0e0;
        }

        .news-container {
            text-align: left;
            margin-top: 20px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <h2>ลบข่าวสาร</h2>

    <div class="delete-news">
        <form action="deletenews.php" method="post">
            <input type="hidden" name="news_id" value="1"> <!-- แทน 1 ด้วย ID ของข่าวที่ต้องการลบ -->
            <input type="submit" value="ลบข่าวสาร">
        </form>
    </div>

    <div class="news-container">
        <?php
        // แสดงข้อมูลข่าวสาร
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"] . " - หัวข้อ: " . $row["title"] . " - เนื้อหา: " . $row["content"] . "<br>";
            }
        } else {
            echo "ไม่พบข่าวสาร";
        }
        ?>
    </div>
</body>

</html>


<<?php
    // กำหนดค่าตัวแปรเชื่อมต่อฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "alumni_db";

    // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // รับค่า ID จากฟอร์ม
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $news_id = $_POST["news_id"];

        // สร้างคำสั่ง SQL สำหรับลบข้อมูล
        $sql = "DELETE FROM news WHERE id = $news_id";

        // ทำการลบข้อมูล
        if ($conn->query($sql) === TRUE) {
            echo "ลบข่าวสารเรียบร้อยแล้ว<br>";

            // ดึงข้อมูลข่าวสารทั้งหมด
            $sql = "SELECT * FROM news";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // แสดงข้อมูลข่าวสาร
                while ($row = $result->fetch_assoc()) {
                    echo "ID: " . $row["id"] . " - หัวข้อ: " . $row["title"] . " - เนื้อหา: " . $row["content"] . "<br>";
                }
            } else {
                echo "ไม่พบข่าวสาร";
            }
        } else {
            echo "เกิดข้อผิดพลาดในการลบข่าวสาร: " . $conn->error;
        }
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
    ?>