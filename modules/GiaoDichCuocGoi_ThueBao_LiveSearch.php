<?php
include ("ConnectDatabase.php");
if(isset($_POST['query'])){
    $output='';
    $query="select * from thuebao where SoThueBao like '%".$_POST['query']."%' ";
    $result=mysqli_query($conn,$query);
    $output='<ul class="list-unstyled">';
    if(mysqli_num_rows($result) >0){
        while ($row = mysqli_fetch_array($result)){
            $output .='<li>'.$row['SoThueBao'].'<li>';
        }
    }
    else{
        $output .='<li>Không tìm thấy SỐ THUÊ BAO trên CSDL</li>';
    }
    $output .='</ul>';
    echo $output;
}