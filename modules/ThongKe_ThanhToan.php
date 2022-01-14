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
    $select='select * from hoadon where MaHoaDon="'.$id.'"';
    $query1=mysqli_query($conn,$select);
    $row=mysqli_fetch_array($query1);
    if($row['TrangThai'] == 0){
        $update ='update hoadon set TrangThai=1 WHERE MaHoaDon="'.$id.'"';
        mysqli_query($conn,$update);
    }
    header('Location:HoaDon_QuanLi.php');
?>
</body>
</html>

