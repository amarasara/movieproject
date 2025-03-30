<?php
include("conn.php");
include("clogin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Kanit", sans-serif;
            background-color: #121212; /* Dark background */
            margin: 0;
            padding: 20px;
            color: #fff; /* White text for the body */
        }

        .page-container {
            background-color: #1e1e1e; /* Dark container */
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); /* Red-tinted shadow */
            padding: 30px;
            border: 2px solid #c10000; /* Dark red border */
        }

        h1 {
            color: #ffdd00; /* Bright yellow */
            font-weight: 800;
            margin-bottom: 30px;
            border-bottom: 3px solid #c10000; /* Dark red */
            padding-bottom: 15px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 2.8rem; /* Increased font size */
            text-shadow: 0 0 10px #ffdd00, 0 0 20px #ffdd00, 0 0 30px #ffdd00; /* Yellow glowing effect */
            animation: yellowGlow 1.5s ease-in-out infinite alternate;
            line-height: 1.3;
        }

        @keyframes yellowGlow {
            from {
                text-shadow: 0 0 10px #ffdd00, 0 0 20px #ffdd00;
            }
            to {
                text-shadow: 0 0 15px #ffdd00, 0 0 25px #ffdd00, 0 0 35px #ffdd00, 0 0 45px #ffdd00;
            }
        }

        .btn-primary {
            background-color: #c10000; /* Dark red */
            border-color: #900000;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ff3333; /* Bright red */
            border-color: #c10000;
            transform: scale(1.05);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #ff3333; /* Bright red */
            font-size: 0.9em;
        }

        .alert-success {
            background-color: #1e2e1e;
            color: #4CAF50;
            border-color: #4CAF50;
        }

        .alert-danger {
            background-color: #2e1e1e;
            color: #ff3333;
            border-color: #c10000;
        }

        .result-container {
            text-align: center;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            background-color: #2a2a2a;
            border: 2px solid #c10000;
        }

        .success-icon {
            color: #4CAF50;
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .error-icon {
            color: #ff3333;
            font-size: 3rem;
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .page-container {
                padding: 15px;
            }
            h1 {
                font-size: 2.2rem; /* Slightly smaller on mobile */
            }
        }

        @media (min-width: 992px) {
            h1 {
                font-size: 3.2rem; /* Even larger on desktops */
            }
        }
    </style>

    <title>อัพเดตข้อมูลการจองภาพยนตร์</title>
</head>

<body>
    <div class="container page-container">
        <h1 class="text-center">อัพเดตข้อมูลการจองภาพยนตร์</h1>
        
        <?php
        // ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // รับค่าจากฟอร์ม
            $movie_id = $_POST['movie_id'];
            $movie_title = $_POST['movie_title'];
            $show_month = $_POST['show_month'];
            $customer_name = $_POST['customer_name'];
            $seat_number = $_POST['seat_number'];
            $employee_name = $_POST['employee_name'];
            $movie_genre = $_POST['movie_genre'];

            // สร้างคำสั่ง SQL สำหรับการอัพเดตข้อมูล
            $sql = "UPDATE movies SET 
                    movie_title='$movie_title',
                    show_month='$show_month',
                    customer_name='$customer_name',
                    seat_number='$seat_number',
                    employee_name='$employee_name',
                    movie_genre='$movie_genre' 
                    WHERE movie_id=$movie_id";

            // ประมวลผลคำสั่ง SQL
            if ($conn->query($sql) === TRUE) {
                echo '
                <div class="result-container">
                    <i class="success-icon">✓</i>
                    <div class="alert alert-success">
                        อัพเดตข้อมูลการจองหนังเรียบร้อยแล้ว
                    </div>
                    <div class="mt-4">
                        <a href="show.php" class="btn btn-primary">กลับไปหน้าแสดงข้อมูล</a>
                    </div>
                </div>';
            } else {
                echo '
                <div class="result-container">
                    <i class="error-icon">✗</i>
                    <div class="alert alert-danger">
                        มีข้อผิดพลาด: ' . $conn->error . '
                    </div>
                    <div class="mt-4">
                        <a href="edit_1.php?action_even=edit&movie_id=' . $movie_id . '" class="btn btn-primary">กลับไปแก้ไขใหม่</a>
                    </div>
                </div>';
            }
        } else {
            // ถ้าไม่มีการส่งข้อมูลจากฟอร์ม ให้กลับไปหน้าแสดงข้อมูล
            echo '<script>window.location.href = "show.php";</script>';
        }
        
        // ปิดการเชื่อมต่อฐานข้อมูล
        $conn->close();
        ?>

        <div class="footer mt-4">
            พัฒนาโดย 664485045 น.ส.อมราพร สาระคนธ์ หมู่เรียน 66/96
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>