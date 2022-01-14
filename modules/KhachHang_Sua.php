<?php
//include ("header'.php");
//include ("LeftMenu.php");
//require_once ('ConnectDatabase.php');
//if(isset($_GET['id'])) {
//    $id=$_GET['id'];
//    $sql1='SELECT * FROM khachhang WHERE SoChungMinh='.$id;
//    $khachhang= executeSingleResult($sql1);
//    if($khachhang != null){
//        $tenkh=$khachhang['TenKhachHang'];
//        $diachi=$khachhang['DiaChi'];
//        $image = $khachhang['anh'];
//        $gioitinh=$khachhang['GioiTinh'];
//        $email=$khachhang['gmail'];
//    }
//}
//if(!empty($_POST)){
//
//    $tenkh=$_POST['tenkhachhang'];
//    $diachi=$_POST['diachi'];
//    $socm=$_POST['sochungminh'];
//    $email = $_POST['email'];
//    $gt='';
//    if($_POST['gioitinh'] == 0){
//        $gt=0;
//    }else{
//        $gt=1;
//    }
//
//    $image = $_POST['anh'];
//
//    $file_name = $_FILES['image']['name'];
//    $file_size = $_FILES['image']['size'];
//    $file_tmp = $_FILES['image']['tmp_name'];
//    $file_type = $_FILES['image']['type'];
//    $file_parts =explode('.',$_FILES['image']['name']);
//    $file_ext=strtolower(end($file_parts));
//    $expensions= array("jpeg","jpg","png");
//    if(in_array($file_ext,$expensions)=== false){
//        $errors="Chỉ hỗ trợ upload file JPEG hoặc PNG.";
//    }
//    if($file_size > 2097152) {
//        $errors='Kích thước file không được lớn hơn 2MB';
//    }
//    $anh = $_FILES['image']['name'];
//    $target = "../image/".basename($anh);
//    if(!empty($errors)){
//        echo '<script language="javascript">';
//        echo 'alert("'.$errors.'")';
//        echo '</script>';
//    }else{
//        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
//
//        }else{
//
//        }
//        $sql='UPDATE KhachHang SET TenKhachHang="'.$tenkh.'", DiaChi="'.$diachi.'", gmail="'.$email.'",anh="'.$image.'", GioiTinh='.$gt.' WHERE SoChungMinh='.$socm.' ';
//        if(mysqli_query($conn,$sql)){
//            echo '<script language="javascript">';
//            echo 'alert("Sửa khách hàng thành công")';
//            echo 'alert("'.$image.'")';
//            echo '</script>';
//        }else{
//            echo '<script language="javascript">';
//            echo 'alert("Sửa khách hàng thất bại")';
//            echo '</script>';
//        }
//    }
//
//
//
//}
//?>
<!--<div class="container" style="max-width: 50%;">-->
<!---->
<!--    <div class="col-lg-12">-->
<!--        <div class="row mb-4 mt-4">-->
<!--            <div class="col-md-12">-->
<!--                <h2>Sửa thông tin khách hàng</h2>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
<!--                <div class="card">-->
<!--                    <div class="card-body ">-->
<!--                        <form action=""  method="post" onsubmit="validate()" enctype="multipart/form-data">-->
<!--                            <table class="table table-borderless">-->
<!--                                <tr>-->
<!--                                    <td>-->
<!--                                        <label for="uname" >Số chứng minh</label>-->
<!--                                        <input type="text" class="form-control" id="sochungminh" name="sochungminh" value="--><?//=$id?><!--" required style="background: #fff9c8">-->
<!--                                    </td>-->
<!--                                    <td>-->
<!--                                        <label for="uname" >Tên khách hàng</label>-->
<!--                                        <input type="text" class="form-control" id="tenkhachhang" value="--><?//=$tenkh?><!--" name="tenkhachhang" required style="background: #fff9c8">-->
<!--                                    </td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>-->
<!--                                        <label for="uname" >Địa chỉ</label>-->
<!--                                        <input type="text" class="form-control" id="diachi" value="--><?//=$diachi?><!--" name="diachi" required style="background: #fff9c8">-->
<!--                                    </td>-->
<!--                                    <td>-->
<!--                                        <label for="uname" >Email</label>-->
<!--                                        <input type="email" class="form-control" id="email" name="email" value="--><?//=$email?><!--" required style="background: #fff9c8">-->
<!--                                    </td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td colspan="2">-->
<!--                                        <label for="uname" >Giới tính:  </label>-->
<!--                                        <label class="radio-inline"  style="margin-left: 20px">-->
<!--                                            <input type="radio" name="gioitinh" id="nam" value="1" checked>   Nam-->
<!--                                        </label>-->
<!--                                        <label class="radio-inline" style="margin-left: 20px">-->
<!--                                            <input type="radio" name="gioitinh" id="nu" value="0">    Nữ-->
<!--                                        </label>-->
<!--                                    </td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td colspan="2">-->
<!--                                        <label for="uname" >Ảnh đại diện:</label>-->
<!--                                        <input style="margin-right: 100px;" type="file" name="image" id="image" accept="image/gif, image/jpeg, image/png" onchange="chooseFile(this)">-->
<!--                                        --><?php //echo "<img src='../image/".$image."' width='100' height='150' id='anh' name='anh'>";?>
<!--                                    </td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td colspan="2" style="text-align: right">-->
<!--                                        <button type="submit" class="btn btn-primary" >Lưu thông tin</button>-->
<!--                                        <!--                                            <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="QuanLiKhachHang.php"  >Hủy</a></span>-->-->
<!--                                        <!--                                            <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" style="margin-right:30px"-->-->
<!--                                        <!--                                                -->-->
<!--                                        <!--                                                >Lưu thông tin</a></span>-->-->
<!--                                    </td>-->
<!--                                </tr>-->
<!--                            </table>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <script>-->
<!--        // Disable form submissions if there are invalid fields-->
<!--        (function() {-->
<!--            'use strict';-->
<!--            window.addEventListener('load', function() {-->
<!--                // Get the forms we want to add validation styles to-->
<!--                var forms = document.getElementsByClassName('needs-validation');-->
<!--                // Loop over them and prevent submission-->
<!--                var validation = Array.prototype.filter.call(forms, function(form) {-->
<!--                    form.addEventListener('submit', function(event) {-->
<!--                        if (form.checkValidity() === false) {-->
<!--                            event.preventDefault();-->
<!--                            event.stopPropagation();-->
<!--                        }-->
<!--                        form.classList.add('was-validated');-->
<!--                    }, false);-->
<!--                });-->
<!--            }, false);-->
<!--        })();-->
<!--        function chooseFile(fileInput) {-->
<!--            if(fileInput.files && fileInput.files[0]){-->
<!--                var reader = new FileReader();-->
<!--                reader.onload = function (e) {-->
<!--                    $('#anh').attr('src',e.target.result);-->
<!--                }-->
<!--            }-->
<!--            reader.readAsDataURL(fileInput.files[0]);-->
<!--        }-->
<!--    </script>-->
<!---->
