<?php
    include("conn.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background-color: #1e1e1e; /* Dark container */
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); /* Red-tinted shadow */
            padding: 30px;
            border: 2px solid #c10000; /* Dark red border */
            max-width: 500px;
            width: 100%;
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
            font-size: 2.2rem; /* Adjusted font size */
            text-shadow: 0 0 10px #ffdd00, 0 0 20px #ffdd00; /* Yellow glowing effect */
            animation: yellowGlow 1.5s ease-in-out infinite alternate;
        }

        @keyframes yellowGlow {
            from {
                text-shadow: 0 0 10px #ffdd00, 0 0 20px #ffdd00;
            }
            to {
                text-shadow: 0 0 15px #ffdd00, 0 0 25px #ffdd00, 0 0 35px #ffdd00;
            }
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

        .alert-warning {
            background-color: #2e2e1e;
            color: #FFC107;
            border-color: #FFC107;
        }

        .login-message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        .btn-redirect {
            background-color: #c10000; /* Dark red */
            border-color: #900000;
            color: white;
            padding: 10px 20px;
            transition: all 0.3s ease;
            display: block;
            width: 100%;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-weight: 500;
            margin-top: 20px;
        }

        .btn-redirect:hover {
            background-color: #ff3333; /* Bright red */
            border-color: #c10000;
            transform: scale(1.05);
            color: white;
        }
    </style>
    
    <title>ตรวจสอบการเข้าสู่ระบบ</title>
</head>
<body>
    <div class="login-container">
        <h1>ตรวจสอบการเข้าสู่ระบบ</h1>
        
        <?php
            // เช็คค่า
            $u_id = $_POST['u_id'];
            $u_passwd = $_POST['u_passwd'];
            
            // เช็ค ชื่อผู้ใช้ กับ รหัสผ่านว่าตรงกับในฐานข้อมูลหรือไม่
            $lvsql = "SELECT * FROM userdata WHERE u_id='$u_id' and u_passwd='$u_passwd'";
            
            $result = $conn->query($lvsql);
            if($result->num_rows == 0){
                echo "<div class='login-message alert-danger'>ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาตรวจสอบ</div>";
                echo "<a href='login.php' class='btn-redirect'>กลับไปหน้าเข้าสู่ระบบ</a>";
            } else {
                //get user data
                $row = $result->fetch_assoc();
                
                // กำหนดตัวแปร session
                $_SESSION["u_id"] = $u_id;
                $_SESSION["u_passwd"] = $row['u_passwd'];
                $_SESSION["u_name"] = $row['u_name'];
                
                echo "<div class='login-message alert-success'>เข้าสู่ระบบสำเร็จ กำลังนำท่านไปยังระบบ...</div>";
                
                // Redirect with JavaScript for better user experience
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'show.php';
                    }, 1500);
                </script>";
                
                echo "<a href='show.php' class='btn-redirect'>ไปยังระบบทันที</a>";
            }
        ?>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>