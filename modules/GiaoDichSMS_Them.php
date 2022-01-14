<?php
include ("header'.php");
include ("LeftMenu.php");
require_once ('ConnectDatabase.php');
if(!empty($_POST)){
    $sothuebao=$_POST['sothuebao'];
    $goisms=$_POST['goisms'];
    $time=$_POST['time'];
//    echo '<script language="javascript">';
//    echo 'alert("'.$goisms.'")';
//    echo '</script>';
    $querysms="select * from sms  where MaSMS='".$goisms."' ";
    $list=mysqli_query($conn,$querysms);
    while($row=mysqli_fetch_array($list)){
        $phisms=$row['PhiSMS'];
    }
    if(empty($phisms)){
        $phisms=0;
    }
    $sql='INSERT INTO chitietsms (MaSMS,PhiSMS,ThoiGian,SoThueBao) VALUES("'.$goisms.'",'.$phisms.',"'.$time.'","'.$sothuebao.'")';
    $sqlCheck="SELECT * FROM HoaDon where SoThueBao='".$sothuebao."'";
    $check=  mysqli_num_rows(mysqli_query($conn,$sqlCheck));
    if($check !=0){
        if(mysqli_query($conn,$sql)){
            $sql2='select * from chitietsms where SoThueBao = "'.$sothuebao.'"';
            $list2=mysqli_query($conn,$sql2);
            $tiensms1=0;
            while($row = mysqli_fetch_array($list2)){
                $tiensms1 = $tiensms1 + $row['PhiSMS'];
            }
            $list1=mysqli_query($conn,$sqlCheck);
            while($row=mysqli_fetch_array($list1)){
                $tienCGHD = $row['TienCuocGoi'];
                $tienInternet = $row['TienInternet'];
                $vat = (($tienCGHD+$tiensms1+$tienInternet)*10)/100;
                $tongtien = $tienCGHD + $tiensms1 + $tienInternet + $vat;
            }
            $sql1='UPDATE HoaDon SET TienSMS='.$tiensms1.',TienCuocGoi='.$tienCGHD.',TienInternet='.$tienInternet.',VAT='.$vat.',TongTien='.$tongtien.' WHERE SoThueBao="'.$sothuebao.'" ';
            mysqli_query($conn,$sql1);
            echo '<script language="javascript">';
            echo 'location.href="GiaoDichSMS_QuanLi.php"';
            echo '</script>';
            die();
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Thêm bản ghi thất bại")';
            echo '</script>';
        }
    }else{
        if(mysqli_query($conn,$sql)){
            echo '<script language="javascript">';
            echo 'location.href="GiaoDichSMS_QuanLi.php"';
            echo '</script>';
            die();
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Thêm bản ghi thất bại")';
            echo '</script>';
        }
    }
//    if(mysqli_query($conn,$sql) ){
//        echo '<script language="javascript">';
//        echo 'location.href="GiaoDichSMS_QuanLi.php"';
//        echo '</script>';
//        die();
//    }else{
//        echo '<script language="javascript">';
//        echo 'alert("Thêm bản ghi thất bại")';
//        echo '</script>';
//    }
}
?>
<div class="container" style="max-width: 50%;">
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Thêm mới giao dịch SMS</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body ">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" onsubmit="validate()">
                            <table class="table table-borderless">
                                <tr>
                                    <td>
                                        <label>Số thuê bao</label>
                                        <input type="text" name="sothuebao" id="sothuebao" class="form-control" placeholder="">
                                        <div id="soDienThoaiList">

                                        </div>

                                    </td>
                                </tr>
                                <tr>

                                    <td> <label for="uname" >Thời gian</label>
                                        <input type="datetime-local" class="form-control"  id="time" name="time" required style="background: #fff9c8">
                                    </td>
                                </tr>

                                <tr>
                                    <td> <label for="uname" >Gói cước SMS (Sử dụng)</label>
                                        <select class="form-control" name="goisms" id="goisms">
                                            <option>---Chọn gói SMS sử dụng---</option>
                                            <?php
                                            $sqlTB='select * from sms';
                                            $listTB= executeResult($sqlTB);
                                            foreach ($listTB as $item){
                                                echo '<option value="'.$item['MaSMS'].'">'.$item['TenGoiSMS'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="text-align: right">
                                        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Disable form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        $(document).ready(function () {
            $('#sothuebao').keyup(function () {
                var query =$(this).val();
                if(query != ''){
                    $.ajax({
                        url:"GiaoDichCuocGoi_ThueBao_LiveSearch.php",
                        method:"POST",
                        data:{query:query},
                        success:function (data) {
                            $('#soDienThoaiList').fadeIn();
                            $('#soDienThoaiList').html(data);
                        }
                    });
                }else{
                    $('#soDienThoaiList').fadeOut();
                    $('#soDienThoaiList').html("");
                }
            });
            $(document).on('click','li',function () {
                $('#sothuebao').val($(this).text());
                $('#soDienThoaiList').fadeOut();
            });
        });
    </script>