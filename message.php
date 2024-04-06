<!DOCTYPE html>
<html>

<head>
    <title>เพิ่มข่าวสาร</title>
</head>

<body>

    <h2>เพิ่มข่าวสาร</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        หัวข้อข่าว: <input type="text" name="title"><br>
        เนื้อหาข่าว: <textarea name="content" rows="5" cols="40"></textarea><br>
        หรือเลือกไฟล์รูปภาพ: <input type="file" name="image_file"><br>
        ประเภทข่าว:
        <select name="category_id">
            <option value="1">เเนะนำศิษเก่า</option>
            <option value="2">การบริจาค</option>
            <option value="3">อาสาสมัคร</option>
            <option value="4">กิจกรรม</option>
        </select><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    // ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // สร้างการเชื่อมต่อกับฐานข้อมูล
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "alumni_db";

        $conn = new mysqli($servername, $username, $password, $dbname);
        // ตรวจสอบการเชื่อมต่อ
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // ดึงข้อมูลจากฟอร์ม
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category_id = $_POST['category_id'];

        // ตรวจสอบว่ามีการอัพโหลดไฟล์รูปภาพหรือไม่
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image_file']['name']; // ชื่อไฟล์รูปภาพที่อัปโหลด
            $target_dir = "png-web/"; // เปลี่ยนโฟลเดอร์เป็น "png-web/"
            $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
                echo "Sorry, only JPG, JPEG, PNG files are allowed.";
                exit();
            }
            // Check file size (not exceeding 1MB)
            if ($_FILES["image_file"]["size"] > 8000000) {
                echo "Sorry, your file is too large. Max file size is 8MB.";
                exit();
            }
            move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file);
        } else {
            $image = ''; // ไม่มีรูปภาพ
        }

        // เพิ่มข้อมูลลงในฐานข้อมูล
        $sql = "INSERT INTO news (title, content, image_url, category_id) VALUES ('$title', '$content', '$image', $category_id)";

        if ($conn->query($sql) === TRUE) {
            echo "เพิ่มข่าวสารเรียบร้อยแล้ว";
            echo '<script>window.location.replace("index.php");</script>';
            exit(); // Ensure script stops here to prevent further execution
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

</body>

</html>
