<?php
include ("header'.php");
include ("LeftMenu.php");
require_once ('ConnectDatabase.php');
if(!empty($_POST)){
    $sothuebao=$_POST['sothuebao'];
    $macuocgoi=$_POST['macuoc'];
    $tg_bd=$_POST['tg_bd'];
    $tg_kt=$_POST['tg_kt'];
    $sdt_goi=$_POST['sdt_goi'];
    $tg_bd_convert=strtotime($tg_bd);
    $tg_kt_convert=strtotime($tg_kt);
    $sophutgoi=$tg_kt_convert-$tg_bd_convert;
    if($sophutgoi <0){
        echo '<script language="javascript">';
        echo 'alert("Thời gian gọi không hợp lệ")';
        echo '</script>';
    }
    else{
        $phut=$sophutgoi/60;
        $querycuocgoi="select * from cuocgoi where MaCuocGoi='".$macuocgoi."' ";
        $list=mysqli_query($conn,$querycuocgoi);
        while($row=mysqli_fetch_array($list)){
            $phigoi=$row['PhiCuocGoi'];
        }
        if(empty($phigoi)){
            $phigoi=0;
        }
        $tongtiengoi= $phut * $phigoi;
        $sql='INSERT INTO chitietcuocgoi (id_cuocgoi,MaCuocGoi,TG_BD,TG_KT,SDT_goi,TongTienGoi,SoThueBao) VALUES( null,"'.$macuocgoi.'","'.$tg_bd.'","'.$tg_kt.'","'.$sdt_goi.'",'.$tongtiengoi.',"'.$sothuebao.'")';
        $sqlCheck="SELECT * FROM HoaDon where SoThueBao='".$sothuebao."'";
        $check=  mysqli_num_rows(mysqli_query($conn,$sqlCheck));
        if($check !=0){
            if(mysqli_query($conn,$sql)){
                $sql2='select * from chitietcuocgoi where SoThueBao = "'.$sothuebao.'"';
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
                $sql1='UPDATE HoaDon SET TienSMS='.$tienSMS.',TienCuocGoi='.$tienCGHD.',TienInternet='.$tienInternet.',VAT='.$vat.',TongTien='.$tongtien.' WHERE SoThueBao="'.$sothuebao.'" ';
                mysqli_query($conn,$sql1);
                echo '<script language="javascript">';
                echo 'location.href="GiaoDichCuocGoi_QuanLi.php"';
                echo '</script>';
                die();
            }
            else{
                echo '<script language="javascript">';
                echo 'alert("Thêm thất bại")';
                echo '</script>';
            }
        }else{
            if(mysqli_query($conn,$sql)){
                echo '<script language="javascript">';
                echo 'location.href="GiaoDichCuocGoi_QuanLi.php"';
                echo '</script>';
                die();
            }
            else{
                echo '<script language="javascript">';
                echo 'alert("Thêm thất bại")';
                echo '</script>';
            }
        }

    }
    }
//    echo '<script language="javascript">';
//    echo 'alert("'.$phigoi.'")';
//    echo '</script>';{

?>
<div class="container" style="max-width: 50%;">
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Thêm mới giao dịch cước gọi</h2>
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
                                    <td> <label for="uname" >Gói cước gọi (Sử dụng)</label>
                                        <select class="form-control" name="macuoc" id="macuoc">
                                            <option>---Chọn cước gọi sử dụng---</option>
                                            <?php
                                            $sqlTB='select * from cuocgoi';
                                            $listTB= executeResult($sqlTB);
                                            foreach ($listTB as $item){
                                                echo '<option value="'.$item['MaCuocGoi'].'">'.$item['TenCuocGoi'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <label for="uname" >Thời gian bắt đầu gọi</label>
                                        <input type="datetime-local" class="form-control"  id="tg_bd" name="tg_bd" required style="background: #fff9c8">
                                    </td>
                                    <td> <label for="uname" >Thời gian kết thúc gọi</label>
                                        <input type="datetime-local" class="form-control"  id="tg_kt" name="tg_kt" required style="background: #fff9c8">
                                    </td>
                                </tr>
                                <tr>
                                    <td > <label for="uname" >Số điện thoại gọi</label>
                                        <input type="number" class="form-control"  id="sdt_goi" name="sdt_goi" required style="background: #fff9c8">
                                    </td>
                                </tr>
<!--                                <tr>-->
<!--                                    <td> <label for="uname" >Số thuê bao</label>-->
<!--                                        <select class="form-control" name="sothuebao" id="sothuebao">-->
<!--                                            <option>---Chọn số thuê bao---</option>-->
<!--                                            --><?php
//                                            $sqlTB='select * from thuebao';
//                                            $listTB= executeResult($sqlTB);
//                                            foreach ($listTB as $item){
//                                                echo '<option value="'.$item['SoThueBao'].'">'.$item['SoThueBao'].'</option>';
//                                            }
//                                            ?>
<!--                                        </select>-->
<!--                                    </td>-->
<!--                                </tr>-->
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