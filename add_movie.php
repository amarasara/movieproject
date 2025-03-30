<?php
include("conn.php");
include("clogin.php");
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลการจองหนัง | ระบบจัดการข้อมูลโรงภาพยนตร์</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Kanit", sans-serif;
            background-color: #121212; /* Dark background */
            margin: 0;
            padding: 20px;
            color: #fff; /* White text for the body */
        }

        .add-container {
            background-color: #1e1e1e; /* Dark container */
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); /* Red-tinted shadow */
            padding: 30px;
            border: 2px solid #c10000; /* Dark red border */
            max-width: 800px;
            margin: 0 auto;
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

        .form-label {
            color: #ffdd00; /* Yellow label text */
            font-weight: 500;
        }

        .form-control, .form-select {
            background-color: #2a2a2a;
            border-radius: 5px;
            border-color: #c10000; /* Dark red */
            color: #fff;
        }

        .form-control:focus, .form-select:focus {
            background-color: #2a2a2a;
            border-color: #ff3333;
            box-shadow: 0 0 0 0.25rem rgba(255, 51, 51, 0.25);
            color: #fff;
        }

        .btn-custom-save {
            background-color: #c10000; /* Dark red */
            border-color: #900000;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-custom-save:hover {
            background-color: #ff3333; /* Bright red */
            border-color: #c10000;
            transform: scale(1.05);
        }

        .btn-custom-cancel {
            background-color: #500000; /* Very dark red */
            border-color: #300000;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-custom-cancel:hover {
            background-color: #700000;
            border-color: #500000;
            transform: scale(1.05);
        }

        .btn-custom-view {
            background-color: #2a2a2a; /* Dark gray */
            border-color: #c10000;
            color: #ffdd00;
            transition: all 0.3s ease;
        }

        .btn-custom-view:hover {
            background-color: #3a3a3a;
            border-color: #ff3333;
            color: #ffdd00;
            transform: scale(1.05);
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

        .text-muted {
            color: #ff3333 !important; /* Bright red */
        }

        .invalid-feedback {
            color: #ff6666;
        }

        /* ส่วนของ User Info Box */
        .user-info-container {
            margin-bottom: 25px;
        }
        
        .user-info-box {
            display: flex;
            align-items: center;
            background-color: #2a2a2a;
            border: 2px solid #c10000;
            border-radius: 8px;
            padding: 12px 20px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(255, 0, 0, 0.2);
        }
        
        .user-info-title {
            font-weight: 600;
            color: #ffdd00;
            margin-right: 10px;
            white-space: nowrap;
        }
        
        .user-info-data {
            color: #fff;
            border-left: 2px solid #c10000;
            padding-left: 15px;
            margin-left: 5px;
        }

        @media (max-width: 768px) {
            .add-container {
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
</head>

<body>
    <div class="container add-container">
        <h1>เพิ่มข้อมูลการจองหนัง</h1>
        
        <div class="user-info-box">
            <div class="user-info-title">ผู้เข้าสู่ระบบ :</div>
            <div class="user-info-data">พัฒนาโดย 664485045 น.ส.อมราพร สาระคนธ์</div>
        </div>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="needs-validation" novalidate id="movieForm">
            <div class="row mb-3">
                <label for="movie_title" class="col-sm-3 col-form-label form-label">ชื่อเรื่อง</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="movie_title" name="movie_title" required>
                    <div class="invalid-feedback">
                        กรุณากรอกชื่อเรื่องหนัง
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="show_month" class="col-sm-3 col-form-label form-label">เดือนที่ฉาย</label>
                <div class="col-sm-9">
                    <select name="show_month" id="show_month" class="form-select" required>
                        <option value="" selected disabled>เลือกเดือนที่ฉาย</option>
                        <option value="มกราคม 2025">มกราคม 2025</option>
                        <option value="กุมภาพันธ์ 2025">กุมภาพันธ์ 2025</option>
                        <option value="มีนาคม 2025">มีนาคม 2025</option>
                        <option value="เมษายน 2025">เมษายน 2025</option>
                        <option value="พฤษภาคม 2025">พฤษภาคม 2025</option>
                        <option value="มิถุนายน 2025">มิถุนายน 2025</option>
                        <option value="กรกฎาคม 2025">กรกฎาคม 2025</option>
                        <option value="สิงหาคม 2025">สิงหาคม 2025</option>
                        <option value="กันยายน 2025">กันยายน 2025</option>
                        <option value="ตุลาคม 2025">ตุลาคม 2025</option>
                        <option value="พฤศจิกายน 2025">พฤศจิกายน 2025</option>
                        <option value="ธันวาคม 2025">ธันวาคม 2025</option>
                    </select>
                    <div class="invalid-feedback">
                        กรุณาเลือกเดือนที่ฉาย
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="customer_name" class="col-sm-3 col-form-label form-label">ชื่อลูกค้า</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                    <div class="invalid-feedback">
                        กรุณากรอกชื่อลูกค้า
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="seat_number" class="col-sm-3 col-form-label form-label">หมายเลขที่นั่ง</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="seat_number" name="seat_number" required>
                    <div class="invalid-feedback">
                        กรุณากรอกหมายเลขที่นั่ง
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="employee_name" class="col-sm-3 col-form-label form-label">พนักงานดูแล</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="employee_name" name="employee_name" required>
                    <div class="invalid-feedback">
                        กรุณากรอกชื่อพนักงานดูแล
                    </div>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="movie_genre" class="col-sm-3 col-form-label form-label">แนวหนัง</label>
                <div class="col-sm-9">
                    <select name="movie_genre" id="movie_genre" class="form-select" required>
                        <option value="" selected disabled>เลือกแนวหนัง</option>
                        <option value="แอคชั่น">แอคชั่น</option>
                        <option value="คอมิดี้">คอมิดี้</option>
                        <option value="ดราม่า">ดราม่า</option>
                        <option value="แฟนตาซี">แฟนตาซี</option>
                        <option value="ไซไฟ">ไซไฟ</option>
                        <option value="สยองขวัญ">สยองขวัญ</option>
                        <option value="อนิเมชั่น">อนิเมชั่น</option>
                        <option value="ครอบครัว">ครอบครัว</option>
                    </select>
                    <div class="invalid-feedback">
                        กรุณาเลือกแนวหนัง
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-custom-save me-2">
                    บันทึกข้อมูล
                </button>
                <button type="button" class="btn btn-custom-cancel me-2" onclick="window.location.href='show.php'">
                    ยกเลิก
                </button>
                <a href="show.php" class="btn btn-custom-view">
                    แสดงข้อมูล
                </a>
            </div>
        </form>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Include database connection
            // Already included at the top
            
            // Get form data and sanitize inputs
            $movie_title = mysqli_real_escape_string($conn, $_POST['movie_title']);
            $show_month = mysqli_real_escape_string($conn, $_POST['show_month']);
            $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
            $seat_number = mysqli_real_escape_string($conn, $_POST['seat_number']);
            $employee_name = mysqli_real_escape_string($conn, $_POST['employee_name']);
            $movie_genre = mysqli_real_escape_string($conn, $_POST['movie_genre']);
            
            // Insert data into database
            $sql = "INSERT INTO movies (movie_title, show_month, customer_name, seat_number, employee_name, movie_genre) 
                    VALUES ('$movie_title', '$show_month', '$customer_name', '$seat_number', '$employee_name', '$movie_genre')";
            
            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success mt-3 text-center">
                        บันทึกข้อมูลการจองหนังเรียบร้อยแล้ว
                      </div>';
            } else {
                echo '<div class="alert alert-danger mt-3 text-center">
                        เกิดข้อผิดพลาด: ' . $conn->error . '
                      </div>';
            }
            
            // Close connection
            $conn->close();
        }
        ?>

        <div class="text-center mt-3 text-muted small">
            พัฒนาโดย 664485045 น.ส.อมราพร สาระคนธ์
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Form Validation Script -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            
            // Loop over them and prevent submission
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>