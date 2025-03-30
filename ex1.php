<!DOCTYPE html>
<html lang="en">
<head>
<?php
 include("conn.php")
?>
<!-- เพิ่มส่วน ใช้งาน Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- ส่วนของ DataTable -->
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<!-- เพิ่มส่วน ใช้งาน Google font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Itim&family=Kanit:ital,wght@0,200;0,300;1,100;1,200&family=Prompt:ital,wght@0,200;0,300;1,300&display=swap" rel="stylesheet">

<!-- เพิ่ม CSS ให้ใช้ Font  -->
<style>
    body{
        font-family: 'Kanit', sans-serif;
    }
</style>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจองภาพยนตร์</title>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">ข้อมูลการจองภาพยนตร์</h1>
        
        <table id="moviesTable" class="table table-striped table-hover" style="width:100%">
            <thead>
                <tr class="table-dark">
                    <th>รหัส</th>
                    <th>ชื่อภาพยนตร์</th>
                    <th>เดือนที่ฉาย</th>
                    <th>ชื่อผู้จอง</th>
                    <th>เลขที่นั่ง</th>
                    <th>พนักงาน</th>
                    <th>ประเภทหนัง</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง movies
                    $sql = "SELECT * FROM movies";
                    $result = $conn->query($sql);
                    
                    // ตรวจสอบว่ามีข้อมูลหรือไม่
                    if ($result->num_rows > 0) {
                        // วนลูปแสดงข้อมูลทั้งหมด
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["movie_id"] . "</td>";
                            echo "<td>" . $row["movie_title"] . "</td>";
                            echo "<td>" . $row["show_month"] . "</td>";
                            echo "<td>" . $row["customer_name"] . "</td>";
                            echo "<td>" . $row["seat_number"] . "</td>";
                            echo "<td>" . $row["employee_name"] . "</td>";
                            echo "<td>" . $row["movie_genre"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>ไม่พบข้อมูล</td></tr>";
                    }
                    
                    // ปิดการเชื่อมต่อ
                    $conn->close();
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อภาพยนตร์</th>
                    <th>เดือนที่ฉาย</th>
                    <th>ชื่อผู้จอง</th>
                    <th>เลขที่นั่ง</th>
                    <th>พนักงาน</th>
                    <th>ประเภทหนัง</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

<!-- Latest compiled JavaScript -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    // เริ่มต้นใช้งาน DataTable พร้อมกำหนดค่าภาษาไทย
    $(document).ready(function() {
        $('#moviesTable').DataTable({
            language: {
                lengthMenu: "แสดง _MENU_ รายการต่อหน้า",
                zeroRecords: "ไม่พบข้อมูล",
                info: "แสดงหน้า _PAGE_ จาก _PAGES_",
                infoEmpty: "ไม่พบข้อมูล",
                infoFiltered: "(กรองจากทั้งหมด _MAX_ รายการ)",
                search: "ค้นหา:",
                paginate: {
                    first: "หน้าแรก",
                    last: "หน้าสุดท้าย",
                    next: "ถัดไป",
                    previous: "ก่อนหน้า"
                }
            }
        });
    });
</script>
</html>