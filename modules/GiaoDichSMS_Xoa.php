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
    $xoa1 ='delete from chitietsms WHERE id_sms="'.$id.'"';
    $sqlSTB='select * from chitietsms where id_sms="'.$id.'" ';
    $list=mysqli_query($conn,$sqlSTB);
    while ($row = mysqli_fetch_array($list)){
        $stb = $row['SoThueBao'];
    }
    $sqlCheck='select * from hoadon where SoThueBao="'.$stb.'"';
    $check = mysqli_num_rows(mysqli_query($conn,$sqlCheck));
    if($check != 0 ){
        if(mysqli_query($conn,$xoa1)){
            $sql2='select * from chitietsms where SoThueBao = "'.$stb.'"';
            $list2=mysqli_query($conn,$sql2);
            $tiensms=0;
            while($row = mysqli_fetch_array($list2)){
                $tiensms = $tiensms + $row['PhiSMS'];
            }
            $list1=mysqli_query($conn,$sqlCheck);
            while($row=mysqli_fetch_array($list1)){
                $tienCGHD = $row['TienCuocGoi'];
                $tienInternet = $row['TienInternet'];
                $vat = (($tienCGHD+$tiensms+$tienInternet)*10)/100;
                $tongtien = $tienCGHD + $tiensms + $tienInternet + $vat;
            }
            $sql1='UPDATE HoaDon SET TienSMS='.$tiensms.',TienCuocGoi='.$tienCGHD.',TienInternet='.$tienInternet.',VAT='.$vat.',TongTien='.$tongtien.' WHERE SoThueBao="'.$stb.'" ';
            mysqli_query($conn,$sql1);

        }
    }else{
        mysqli_query($conn,$xoa1);

    }
    echo '<script language="javascript">';
    echo 'location.href="GiaoDichSMS_QuanLi.php"';
    echo '</script>';

?>
</body>
</html>

