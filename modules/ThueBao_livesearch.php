<?php
    include ("ConnectDatabase.php");
    if(isset($_POST['query'])){
        $output='';
        $query="select * from KhachHang where TenKhachHang like '%".$_POST['query']."%' ";
        $result=mysqli_query($conn,$query);
        $output='<ul class="list-unstyled">';
        if(mysqli_num_rows($result) >0){
            while ($row = mysqli_fetch_array($result)){
                $output .='<li>'.$row['SoChungMinh'].' - '.$row['TenKhachHang'].'<li>';
            }
        }
        else{
            $output .='<li>Không tìm thấy khách hàng trên CSDL</li>';
        }
        $output .='</ul>';
        echo $output;

    }