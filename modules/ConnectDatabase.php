<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name="btl_php";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db_name);

// Check connection
if ($conn) {
  $setLang=mysqli_query($conn,"SET NAMES 'utf8'");
}else{
    die("Lỗi kết nối: " . $conn->connect_error);
}
//Thực hiện câu lẹnh sql
function execute($sql) {
    //save data into table
    // open connection to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name="btl_php";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db_name);
    //insert, update, delete
    mysqli_query($conn, $sql);

    //close connection
    mysqli_close($conn);
}
//thực hiện câu lệnh sql trả về kết quả
function executeResult($sql) {
    //save data into table
    // open connection to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name="btl_php";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db_name);
    //insert, update, delete
    $result = mysqli_query($conn, $sql);
    $data   = [];
    while ($row = mysqli_fetch_array($result, 1)) {
        $data[] = $row;
    }
    //close connection
    mysqli_close($conn);
    return $data;
}
//thực hiện câu lệnh sql trả về kết quả
function executeSingleResult($sql) {
    //save data into table
    // open connection to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name="btl_php";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db_name);
    //insert, update, delete
    $result = mysqli_query($conn, $sql);
    $row    = mysqli_fetch_array($result, 1);

    //close connection
    mysqli_close($conn);

    return $row;
}