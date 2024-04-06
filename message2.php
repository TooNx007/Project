<!DOCTYPE html>
<html>

<head>
    <title>ข่าวสาร</title>
    <style>
        @media only screen and (max-width: 600px) {
            .news-item {
                flex-direction: column;
                align-items: stretch;
            }

            .news-image {
                margin-right: 0;
                float: none;
                max-width: 100%;
                margin-bottom: 10px;
            }

            .news-content {
                text-align: center;
                white-space: pre-line;
            }
        }

        body {
            text-align: center;
        }

        .news-image {
            float: left;
            margin-right: 20px;
            max-width: 300px;
            height: 200px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .news-container {
            display: inline-block;
            text-align: left;
            margin-top: 20px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .news-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .news-image {
            float: left;
            margin-right: 20px;
            max-width: 300px;
            height: auto;
            flex: 0 0 300px;
        }

        .news-content {
            flex: 1;
            overflow: hidden;
            text-align: left;
        }

        .post-meta {
            margin-top: 10px;
            font-style: italic;
            font-size: 0.8em;
        }

        .read-more {
            display: block;
            text-align: right;
            margin-top: 10px;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .read-more:hover {
            color: darkblue;
        }

        .category-select {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .category-select select {
            padding: 5px 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
            cursor: pointer;
        }

        .category-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 16px;
            border-radius: 20px;
            border: 1px solid orange;
            /* แก้เป็นสีส้ม */
            background-color: orange;
            /* แก้เป็นสีส้ม */
            color: #f0f0f0;
            /* เปลี่ยนสีตัวอักษรเป็นสีของเว็บ */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .category-button:hover {
            background-color: #e0e0e0;
            text-decoration: none;
            /* เอาเส้นใต้ออก */
        }

        .category-button.active {
            background-color: orange;
            color: white;
            border-color: orange;
            /* แก้เป็นสีส้ม */
        }

        .category-select {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .category-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 16px;
            border-radius: 20px;
            border: 1px solid orange;
            background-color: orange;
            color: #f0f0f0;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 10px;
            /* เพิ่มขอบล่างเพื่อเว้นระยะห่างระหว่างปุ่ม */
        }
    </style>
</head>

<body>
    <h2>ข่าวสาร</h2>

    <div class="category-select">
    <a href="index.php" class="category-button <?php echo $is_home ? 'active' : ''; ?>" id="homeButton" onclick="setActiveButton('homeButton')">หน้าแรก</a>
    <a href="index.php?category=1" class="category-button" id="category1" onclick="setActiveButton('category1')">เเนะนำศิษเก่า</a>
    <a href="index.php?category=2" class="category-button" id="category2" onclick="setActiveButton('category2')">การบริจาค</a>
    <a href="index.php?category=3" class="category-button" id="category3" onclick="setActiveButton('category3')">อาสาสมัคร</a>
    <a href="index.php?category=4" class="category-button" id="category4" onclick="setActiveButton('category4')">กิจกรรม</a><br>
</div>





    <div class="news-container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "alumni_db";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $sql = "SELECT * FROM news";
        if ($category) {
            $sql .= " WHERE category_id= $category";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="news-item">';
                if (!empty($row["image_url"])) {
                    echo '<img src="png-web/' . $row["image_url"] . '" alt="' . $row["title"] . '" class="news-image">';
                }
                echo '<div class="news-content">';
                echo '<h3>' . $row["title"] . '</h3>';
                echo '<p>' . $row["content"] . '</p>';
                echo '<div class="post-meta">โพสต์เมื่อ: ' . $row["created_at"] . '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>

    <script>
        function setActiveButton(id) {
            document.querySelectorAll('.category-button').forEach(function(button) {
                button.classList.remove('active');
            });

            document.getElementById(id).classList.add('active');
        }
    </script>
</body>

</html>