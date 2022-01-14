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
    $xoa1 ='delete from chitietcuocgoi WHERE id_cuocgoi="'.$id.'"';
    $sqlSTB='select * from chitietcuocgoi where id_cuocgoi="'.$id.'" ';
    $list=mysqli_query($conn,$sqlSTB);
    while ($row = mysqli_fetch_array($list)){
        $stb = $row['SoThueBao'];
    }
    $sqlCheck='select * from hoadon where SoThueBao="'.$stb.'"';
    $check = mysqli_num_rows(mysqli_query($conn,$sqlCheck));
    if($check != 0 ){
        if(mysqli_query($conn,$xoa1)){
            $sql2='select * from chitietcuocgoi where SoThueBao = "'.$stb.'"';
            $list2=mysqli_query($conn,$sql2);
            $tienCGHD=0;
            while($row = mysqli_fetch_array($list2)){
                $tienCGHD = $tienCGHD + $row['TongTienGoi'];
            }
            $list1=mysqli_query($conn,$sqlCheck);
            while($row=mysqli_fetch_array($list1)){
                $tienSMS = $row['TienSMS'];
                $tienInternet = $row['TienInternet'];
                $vat = (($tienCGHD+$tienSMS+$tienInternet)*10)/100;
                $tongtien = $tienCGHD + $tienSMS + $tienInternet + $vat;
            }
            $sql1='UPDATE HoaDon SET TienSMS='.$tienSMS.',TienCuocGoi='.$tienCGHD.',TienInternet='.$tienInternet.',VAT='.$vat.',TongTien='.$tongtien.' WHERE SoThueBao="'.$stb.'" ';
            mysqli_query($conn,$sql1);

        }
    }else{
        mysqli_query($conn,$xoa1);

    }
    echo '<script language="javascript">';
    echo 'location.href="GiaoDichCuocGoi_QuanLi.php"';
    echo '</script>';


?>
</body>
</html>

