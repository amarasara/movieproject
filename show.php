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

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

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

        .btn-danger {
            background-color: #500000; /* Very dark red */
            border-color: #300000;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #700000;
            border-color: #500000;
            transform: scale(1.05);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #ff3333; /* Bright red */
            font-size: 0.9em;
        }

        .table {
            margin-top: 20px;
            color: #fff; /* White text for table */
        }

        .table thead {
            background-color: #c10000; /* Dark red header */
            color: white;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #2a2a2a; /* Darker gray */
            color: #fff;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #1e1e1e; /* Dark gray */
            color: #fff;
        }

        .table-hover tbody tr:hover {
            background-color: #3e0000; /* Very dark red hover */
            color: #fff;
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

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            background-color: #2a2a2a;
            color: #fff;
            border: 1px solid #c10000;
        }

        .page-link {
            background-color: #2a2a2a;
            color: #ff3333;
            border-color: #c10000;
        }

        .page-link:hover {
            background-color: #c10000;
            color: #fff;
        }

        .page-item.active .page-link {
            background-color: #c10000;
            border-color: #900000;
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

        .user-action-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
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

    <title>ข้อมูลการจองภาพยนตร์</title>
</head>

<body>
    <div class="container page-container">
        <?php
        if (isset($_GET['action_even']) && $_GET['action_even'] == 'delete') {
            $movie_id = $_GET['movie_id'];
            $sql = "SELECT * FROM movies WHERE movie_id=$movie_id";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $sql = "DELETE FROM movies WHERE movie_id=$movie_id";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success text-center'>ลบข้อมูลสำเร็จ</div>";
                } else {
                    echo "<div class='alert alert-danger text-center'>ลบข้อมูลมีข้อผิดพลาด กรุณาตรวจสอบ !!! </div>" . $conn->error;
                }
            } else {
                echo "<div class='alert alert-warning text-center'>ไม่พบข้อมูล กรุณาตรวจสอบ</div>";
            }
        }
        ?>
        
        <div class="user-info-container">
            <h1 class="text-center">ข้อมูลการจองภาพยนตร์</h1>
            
            <div class="user-info-box">
                <div class="user-info-title">ผู้เข้าสู่ระบบ :</div>
                <div class="user-info-data">พัฒนาโดย 664485045 น.ส.อมราพร สาระคนธ์</div>
            </div>
            
            <div class="user-action-container">
                <a href="add_movie.php" class="btn btn-primary">เพิ่มข้อมูลการจอง</a>
            </div>
        </div>

        <div class="table-responsive">
            <table id="example" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>รหัสการจอง</th>
                        <th>ชื่อเรื่อง</th>
                        <th>เดือนที่ฉาย</th>
                        <th>ชื่อผู้จอง</th>
                        <th>หมายเลขที่นั่ง</th>
                        <th>พนักงานผู้ดูแล</th>
                        <th>แนวหนัง</th>
                        <th>จัดการข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM movies";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["movie_id"] . "</td>";
                            echo "<td>" . $row["movie_title"] . "</td>";
                            echo "<td>" . $row["show_month"] . "</td>";
                            echo "<td>" . $row["customer_name"] . "</td>";
                            echo "<td>" . $row["seat_number"] . "</td>";
                            echo "<td>" . $row["employee_name"] . "</td>";
                            echo "<td>" . $row["movie_genre"] . "</td>";
                            echo '<td>
                                <div class="btn-group" role="group">
                                    <a href="show.php?action_even=delete&movie_id=' . $row['movie_id'] . '" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm(\'ต้องการจะลบข้อมูลการจอง ' . $row['movie_id'] . ' เรื่อง ' . $row['movie_title'] . ' ของคุณ ' . $row['customer_name'] . '?\')"
                                    >
                                       ลบข้อมูล
                                    </a>
                                    <a href="edit_movie.php?action_even=edit&movie_id=' . $row['movie_id'] . '" 
                                       class="btn btn-primary btn-sm"
                                       onclick="return confirm(\'ต้องการจะแก้ไขข้อมูลการจอง ' . $row['movie_id'] . ' เรื่อง ' . $row['movie_title'] . ' ของคุณ ' . $row['customer_name'] . '?\')"
                                    >
                                       แก้ไขข้อมูล
                                    </a>
                                </div>
                            </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>0 results</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <div class="footer mt-4">
            
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        new DataTable('#example', {
            language: {
                search: 'ค้นหา:',
                lengthMenu: 'แสดง _MENU_ รายการ',
                info: 'หน้า _PAGE_ จาก _PAGES_',
                infoEmpty: 'ไม่มีข้อมูล',
                zeroRecords: 'ไม่พบข้อมูล',
                paginate: {
                    first: 'หน้าแรก',
                    last: 'หน้าสุดท้าย',
                    next: 'ถัดไป',
                    previous: 'ก่อนหน้า'
                }
            }
        });
    </script>
</body>
</html>