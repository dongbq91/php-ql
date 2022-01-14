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
    $xoa="delete from thuebao where SoThueBao=".$id." ";
    mysqli_query($conn,$xoa);
    header('Location:ThueBao_QuanLi.php');
    ?>
</body>
</html>

