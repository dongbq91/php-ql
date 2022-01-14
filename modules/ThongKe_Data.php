<?php
    header('Content-Type: application/json');
    require_once("ConnectDatabase.php");
    $data = array();
    $query = "SELECT TrangThai, COUNT(TrangThai) AS size_status FROM HoaDon GROUP BY TrangThai";
    $list = mysqli_query($conn,$query);
    while($row = mysqli_fetch_array($list)){
        $check = $row['TrangThai'];
        if($check == 1){
            $trangthai = 'Đã thanh toán';
        }else{
            $trangthai = 'Chưa thanh toán';
        }
        $data[] = array(
            'TrangThai' => $trangthai,
            'size_status' => $row['size_status'],
        );
    }
    echo json_encode($data);
