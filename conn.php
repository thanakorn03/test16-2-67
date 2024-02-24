<?php
//ห้ามเปลี่ยนชื่อตัวแปร บรรทัดที่ 3-6 ของอาจารย์
$sName = "localhost";
$uName = "root";
$uPass = "";
$db = "qsystem";


try {
    $conn = new PDO(
        "mysql:host=$sName;dbname=$db;charset=UTF8",
         $uName,
         $uPass
    );


    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'You are now connect to the QueueSystem';
} catch (PDOException $e) {
    echo 'Sorry! You cannot connect to the QueueSystem ' . $e->getMessage();
}
?>
