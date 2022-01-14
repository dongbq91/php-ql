<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
    require_once ('ConnectDatabase.php');
    $id= $_GET['id'];
    $xoa12 ='delete from hoadon WHERE MaHoaDon="'.$id.'"';
    mysqli_query($conn,$xoa12);
    header('Location:HoaDon_QuanLi.php');
?>
</body>
</html>

