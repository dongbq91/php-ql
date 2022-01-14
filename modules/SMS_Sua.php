<?php
include ("header'.php");
include ("LeftMenu.php");
require_once ('ConnectDatabase.php');
if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $sql1='SELECT * FROM sms WHERE MaSMS="'.$id.'" ';
    $goicuoc= executeSingleResult($sql1);
    if($goicuoc != null){
        $tengoicuoc=$goicuoc['TenGoiSMS'];
        $phicuoc=$goicuoc['PhiSMS'];
    }
}
if(!empty($_POST)){
    $tengoicuoc=$_POST['tengoicuoc'];
    $phicuoc=$_POST['phicuoc'];
    $macuoc=$_POST['macuoc'];
    $sql='UPDATE sms SET TenGoiSMS="'.$tengoicuoc.'", PhiSMS="'.$phicuoc.'" WHERE MaSMS="'.$macuoc.'"';

    if($goicuoc == null ){
        execute($sql);
        echo '<script language="javascript">';
        echo 'location.href="SMS_QuanLi.php"';
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
                <h2>Sửa thông tin SMS</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body ">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>"  method="post" onsubmit="">
                            <table class="table table-borderless">
                                <tr>
                                    <td> <label for="uname" >Mã gói SMS</label>
                                        <input type="text" class="form-control" value="<?=$id?>" id="macuoc" name="macuoc" required style="background: #fff9c8">
                                    </td>
                                    <td>
                                        <label for="uname" >Tên gói SMS</label>
                                        <input type="text" class="form-control" id="tengoicuoc" value="<?=$tengoicuoc?>" name="tengoicuoc" required style="background: #fff9c8">

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="uname" >Phí SMS (VND)</label>
                                        <input type="number" class="form-control" id="phicuoc" value="<?=$phicuoc?>" name="phicuoc" required style="background: #fff9c8">

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right">
                                        <button type="submit" class="btn btn-primary" >Lưu thông tin</button>
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

