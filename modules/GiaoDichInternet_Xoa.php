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
    $xoa1 ='delete from chitietinternet WHERE id_internet="'.$id.'"';
    $sqlSTB='select * from chitietinternet where id_internet="'.$id.'" ';
    $list=mysqli_query($conn,$sqlSTB);
    while ($row = mysqli_fetch_array($list)){
        $stb = $row['SoThueBao'];
    }
    $sqlCheck='select * from hoadon where SoThueBao="'.$stb.'"';
    $check = mysqli_num_rows(mysqli_query($conn,$sqlCheck));
    if($check != 0 ){
        if(mysqli_query($conn,$xoa1)){
            $sql2='select * from chitietinternet where SoThueBao = "'.$stb.'"';
            $list2=mysqli_query($conn,$sql2);
            $tieninter=0;
            while($row = mysqli_fetch_array($list2)){
                $tieninter = $tieninter + $row['PhiInternet'];
            }
            $list1=mysqli_query($conn,$sqlCheck);
            while($row=mysqli_fetch_array($list1)){
                $tienSMS = $row['TienSMS'];
                $tienCGHD = $row['TienCuocGoi'];
                $vat = (($tienCGHD+$tienSMS+$tieninter)*10)/100;
                $tongtien = $tienCGHD + $tienSMS + $tieninter + $vat;
            }
            $sql1='UPDATE HoaDon SET TienSMS='.$tienSMS.',TienCuocGoi='.$tienCGHD.',TienInternet='.$tieninter.',VAT='.$vat.',TongTien='.$tongtien.' WHERE SoThueBao="'.$stb.'" ';
            mysqli_query($conn,$sql1);
        }
    }else{
        mysqli_query($conn,$xoa1);
    }
    echo '<script language="javascript">';
    echo 'location.href="GiaoDichInternet_QuanLi.php"';
    echo '</script>';
?>
</body>
</html>

