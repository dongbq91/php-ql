<?php
require_once ('ConnectDatabase.php');
if (!empty($_POST)) {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'delete':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];

                    $sql = 'delete from KhachHang where SoChungMinh ="'.$id.'" ' ;
                    mysqli_query($conn,$sql);
                }
                break;
        }
    }
}
