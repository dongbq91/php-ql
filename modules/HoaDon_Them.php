<?php
    include ("header'.php");
    include ("LeftMenu.php");
    require_once ('ConnectDatabase.php');
    if(!empty($_POST)){

        $sothuebao=$_POST['sothuebao'];
        $ngaytao=$_POST['ngaytao'];
        $trangthai=$_POST['trangthai'];
        $manv=$_POST['nhanvien'];
        $querysms="select * from chitietsms inner join thuebao on chitietsms.SoThueBao = thuebao.SoThueBao where chitietsms.SoThueBao='".$sothuebao."' ";
        $result = mysqli_query($conn,$querysms);
        $demdong = mysqli_num_rows($result);
        $phisms=0;
        if($demdong != 0){
            while($row=mysqli_fetch_assoc($result)){
                $phisms=$phisms + $row['PhiSMS'];
            }
        }else{
            $phisms=0;
        }

        $querycuocgoi="select chitietcuocgoi.TongTienGoi from chitietcuocgoi inner join thuebao on chitietcuocgoi.SoThueBao = thuebao.SoThueBao where chitietcuocgoi.SoThueBao='".$sothuebao."' ";
        $result1 = mysqli_query($conn,$querycuocgoi);
        $demdong1 = mysqli_num_rows($result1);
        $phigoi=0;
        if($demdong1 != 0){
            while($row=mysqli_fetch_assoc($result1)){
                $phigoi=$phigoi + $row['TongTienGoi'];
            }
        }else{
            $phigoi=0;
        }

        $queryinternet="select chitietinternet.PhiInternet from chitietinternet inner join thuebao on chitietinternet.SoThueBao = thuebao.SoThueBao where chitietinternet.SoThueBao='".$sothuebao."' ";
        $result2 = mysqli_query($conn,$queryinternet);
        $demdong2 = mysqli_num_rows($result2);
        $phiinternet=0;
        if($demdong2 != 0){

            while($row=mysqli_fetch_assoc($result2)){
                $phiinternet=$phiinternet + $row['PhiInternet'];
            }
        }else{
            $phiinternet=0;
        }
        $s=$phigoi + $phiinternet + $phisms;
        $VAT=($s*10)/100;
        $tongtien=$s+$VAT;
        /*
        if($check == null ){
            execute($sql);
            echo '<script language="javascript">';
            echo 'location.href="HoaDon_QuanLi.php"';
            echo '</script>';
            die();
        }else{
            echo '<script language="javascript">';
            echo 'alert("Mã hóa đơn đã tồn tại")';
            echo '</script>';
        }*/
        $sqlCheck="SELECT * FROM HoaDon where SoThueBao='".$sothuebao."'";
        $check=  mysqli_num_rows(mysqli_query($conn,$sqlCheck));
        if($check !=0){
            $sql1='UPDATE HoaDon SET TienSMS='.$phisms.',TienCuocGoi='.$phigoi.',TienInternet='.$phiinternet.',VAT='.$VAT.',TongTien='.$tongtien.',TrangThai='.$trangthai.',NgayTao="'.$ngaytao.'",MaNhanVien="'.$manv.'" WHERE SoThueBao="'.$sothuebao.'" ';
            if(mysqli_query($conn,$sql1)){
                echo '<script language="javascript">';
                echo 'location.href="HoaDon_QuanLi.php"';
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("Mã hóa đơn đã tồn tại")';
                echo '</script>';
            }
        }else{
            $sql='INSERT INTO hoadon (MaHoaDon,MaNhanVien,SoThueBao,TienSMS,TienCuocGoi,TienInternet,VAT,TongTien,TrangThai,NgayTao) VALUES("'.$mahoadon.'","'.$manv.'","'.$sothuebao.'",'.$phisms.','.$phigoi.','.$phiinternet.','.$VAT.','.$tongtien.','.$trangthai.',"'.$ngaytao.'")';
            if(mysqli_query($conn,$sql)){
                echo '<script language="javascript">';
                echo 'location.href="HoaDon_QuanLi.php"';
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("Mã hóa đơn đã tồn tại")';
                echo '</script>';
            }
        }

    }
?>
<div class="container" style="max-width: 50%;">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Thêm Hóa Đơn</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body ">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>"  method="post" onsubmit="validate()">
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
                                    <td>
                                        <label for="uname" >Ngày tạo</label>
                                        <input type="date" class="form-control" id="ngaytao" value="" name="ngaytao" required style="background: #fff9c8">
                                    </td>
                                </tr>
                                <tr>

                                    <td>
                                        <label for="uname" >Nhân viên lập đơn</label>

                                        <select class="form-control" name="nhanvien" id="nhanvien">
                                            <option>---Chọn mã nhân viên---</option>
                                            <?php

                                            $sqlNv='select * from nhanvien';
                                            $listNv= executeResult($sqlNv);
                                            foreach ($listNv as $item){
                                                echo '<option value="'.$item['MaNhanVien'].'">'.$item['MaNhanVien'].'  -  '.$item['email'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label for="uname" >Trạng thái:</label><br>
                                        <label class="radio-inline"  style="margin-left: 10px;margin-top: 10px">
                                            <input type="radio" name="trangthai" id="datt" value="1" checked> Đã thanh toán
                                        </label><br>
                                        <label class="radio-inline" style="margin-left: 10px">
                                            <input type="radio" name="trangthai" id="chuatt" value="0">Chưa thanh toán
                                        </label>

                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="2" style="text-align: right">
                                        <button type="submit" class="btn btn-primary" >Lưu thông tin</button>
                                        <!--                                            <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="QuanLiKhachHang.php"  >Hủy</a></span>-->
                                        <!--                                            <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" style="margin-right:30px"-->
                                        <!--                                                -->
                                        <!--                                                >Lưu thông tin</a></span>-->
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

