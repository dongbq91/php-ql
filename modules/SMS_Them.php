<?php
include ("header'.php");
include ("LeftMenu.php");
require_once ('ConnectDatabase.php');
if(!empty($_POST)){
    $macuoc=$_POST['macuoc'];
    $tencuoc=$_POST['tengoicuoc'];
    $phicuoc=$_POST['phicuoc'];
    $sql1='SELECT * FROM sms WHERE MaSMS="'.$macuoc.'" ';
    $sql='INSERT INTO sms (MaSMS,TenGoiSMS,PhiSMS) VALUES("'.$macuoc.'","'.$tencuoc.'",'.$phicuoc.')';
    $check=executeResult($sql1);
    if($check == null ){
        execute($sql);
        echo '<script language="javascript">';
        echo 'location.href="SMS_QuanLi.php"';
        echo '</script>';
        die();
    }else{
        echo '<script language="javascript">';
        echo 'alert("Mã cước đã tồn tại")';
        echo '</script>';
    }
}
?>
<div class="container" style="max-width: 50%;">
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Thêm gói SMS mới</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body ">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" onsubmit="validate()">
                            <table class="table table-borderless">
                                <tr>
                                    <td> <label for="uname" >Mã gói SMS</label>
                                        <input type="text" class="form-control"  id="macuoc" name="macuoc" required style="background: #fff9c8">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Mã gói cước không được để trống</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="uname" >Tên gói SMS</label>
                                        <input type="text" class="form-control"  id="tengoicuoc" name="tengoicuoc" required style="background: #fff9c8">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Tên gói cước không được để trống</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="uname" >Phí SMS</label>
                                        <input type="number" class="form-control"  id="phicuoc" name="phicuoc" required style="background: #fff9c8">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Phí cước không được để trống</div>
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

    </script>