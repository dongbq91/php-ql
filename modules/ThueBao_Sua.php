

<?php
    include ("header'.php");
    include ("LeftMenu.php");
    require_once ('ConnectDatabase.php');
    if(isset($_GET['id'])) {
        $id=$_GET['id'];
        $sql1='SELECT * FROM thuebao WHERE SoThueBao='.$id;
        $thuebao= executeSingleResult($sql1);
        if($thuebao != null){
            $ngaykichhoat=$thuebao['NgayKichHoat'];
            $socm=$thuebao['SoChungMinh'];
        }

    }

    if(!empty($_POST)){
        $sothuebao=$_POST['sothuebao'];
        $ngaykichhoat=$_POST['ngaykichhoat'];
        $str=$_POST['socm'];
        $socm_arr=explode(' ',$str);
        $socm=$socm_arr[0];
        $sql='UPDATE thuebao SET NgayKichHoat="'.$ngaykichhoat.'", SoChungMinh="'.$socm.'" WHERE SoThueBao='.$sothuebao;
        if(mysqli_query($conn,$sql) ){
            echo '<script language="javascript">';
            echo 'location.href="ThueBao_QuanLi.php"';
            echo '</script>';
            die();
        }else{
            echo '<script language="javascript">';
            echo 'alert("Lỗi cập nhập")';
            echo '</script>';
        }
    }
?>
<div class="container" style="max-width: 50%;">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Sửa thông tin thuê bao</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body ">
                        <form action="" method="post" onsubmit="validate()">
                            <table class="table table-borderless">
                                <tr>
                                    <td> <label for="uname" >Số thuê bao</label>
                                        <input type="text" class="form-control" value="<?=$id?>"  id="sothuebao" name="sothuebao" required style="background: #fff9c8">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Số thuê bao không được để trống</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="uname" >Ngày kích hoạt</label>
                                        <input type="date" class="form-control" value="<?=$ngaykichhoat?>" id="ngaykichhoat" name="ngaykichhoat" required style="background: #fff9c8">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Ngày kích không được để trống</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Số chứng minh</label>
                                        <input type="text" name="socm" id="socm" value="<?=$socm?>" class="form-control" placeholder="">
                                        <div id="khachHangList">

                                        </div>
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
            $('#socm').keyup(function () {
                var query =$(this).val();
                if(query != ''){
                    $.ajax({
                        url:"ThueBao_livesearch.php",
                        method:"POST",
                        data:{query:query},
                        success:function (data) {
                            $('#khachHangList').fadeIn();
                            $('#khachHangList').html(data);
                        }
                    });
                }else{
                    $('#khachHangList').fadeOut();
                    $('#khachHangList').html("");
                }
            });
            $(document).on('click','li',function () {
                $('#socm').val($(this).text());
                $('#khachHangList').fadeOut();
            });
        });
    </script>
