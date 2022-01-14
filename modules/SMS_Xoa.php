<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <?php
    require_once ('ConnectDatabase.php');
    $id = $_GET['id'];
    $xoa1 ='delete from sms WHERE MaSMS="'.$id.'"';
    mysqli_query($conn,$xoa1);
    header('Location:SMS_QuanLi.php');
    ?>
</body>
</html>

