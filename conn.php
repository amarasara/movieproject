<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($conn->connect_error) {
    die("เชื่อมต่อข้อมูลล้มเหลว" . $conn->connect_error);
  }
  echo "เชื่อมต่อข้อมูลสำเร็จ";
  ?>