<?php
include("conn.php");
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

    <style>
        body {
            font-family: "Kanit", sans-serif;
            background-color: #121212; /* Dark background */
            margin: 0;
            padding: 0;
            color: #fff; /* White text for the body */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .login-container {
            background-color: #1e1e1e; /* Dark container */
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); /* Red-tinted shadow */
            padding: 40px;
            width: 100%;
            max-width: 400px;
            border: 2px solid #c10000; /* Dark red border */
            text-align: center;
            position: relative;
            z-index: 2;
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
            font-size: 2.5rem; /* Increased font size */
            text-shadow: 0 0 10px #ffdd00, 0 0 20px #ffdd00, 0 0 30px #ffdd00; /* Yellow glowing effect */
            animation: yellowGlow 1.5s ease-in-out infinite alternate;
        }

        @keyframes yellowGlow {
            from {
                text-shadow: 0 0 10px #ffdd00, 0 0 20px #ffdd00;
            }
            to {
                text-shadow: 0 0 15px #ffdd00, 0 0 25px #ffdd00, 0 0 35px #ffdd00, 0 0 45px #ffdd00;
            }
        }

        .form-control {
            background-color: #2a2a2a;
            border-radius: 5px;
            border-color: #c10000; /* Dark red */
            color: #fff;
            margin-bottom: 20px;
        }

        .form-control:focus {
            background-color: #2a2a2a;
            border-color: #ff3333;
            box-shadow: 0 0 0 0.25rem rgba(255, 51, 51, 0.25);
            color: #fff;
        }

        .form-label {
            color: #ff3333; /* Bright red */
            font-weight: 500;
            text-align: left;
            display: block;
            margin-bottom: 8px;
        }

        .btn-custom {
            width: 100%;
            margin-top: 15px;
            background-color: #c10000; /* Dark red */
            border-color: #900000;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #ff3333; /* Bright red */
            border-color: #c10000;
            transform: scale(1.05);
        }

        .btn-outline {
            width: 100%;
            margin-top: 10px;
            background-color: transparent;
            border-color: #c10000;
            color: #ff3333;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background-color: #300000;
            color: #fff;
            transform: scale(1.05);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #ff3333; /* Bright red */
            font-size: 0.9em;
        }

        .decoration {
            position: absolute;
            opacity: 0.2;
            z-index: 1;
        }

        .decoration-top-left {
            top: 20px;
            left: 20px;
            transform: rotate(-45deg);
        }

        .decoration-bottom-right {
            bottom: 20px;
            right: 20px;
            transform: rotate(135deg);
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
                margin: 15px;
            }
            h1 {
                font-size: 2rem;
            }
        }
    </style>
    
    <title>เข้าสู่ระบบ</title>
</head>
<body>
    <svg class="decoration decoration-top-left" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="40" fill="#c10000" />
    </svg>
    
    <svg class="decoration decoration-bottom-right" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="40" fill="#c10000" />
    </svg>

    <div class="login-container">
        <h1>เข้าสู่ระบบ</h1>
        <form action="chklogin.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" id="username" name="u_id" maxlength="30" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" id="password" name="u_passwd" maxlength="30" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-custom">เข้าสู่ระบบ</button>
                <button type="reset" class="btn btn-outline">ยกเลิก</button>
            </div>
        </form>
        <div class="footer">
            พัฒนาโดย 664485045 น.ส.อมราพร สาระคนธ์
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>