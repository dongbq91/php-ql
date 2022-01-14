<?php
    header('Content-Type: application/json');
    require_once("ConnectDatabase.php");

//    $data[] = array(
//        'TrangThai' => ['Tiền SMS','Tiền Internet','Tiền cước gọi'],
//        'size_status' =>[$tiensms,$tieninternet,$tiengoi],
//    );


    echo json_encode($data);
