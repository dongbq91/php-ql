<!DOCTYPE html>
<html>
<head>
    <title>Đăng kí tài khoản</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        body{
            background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/142996/slider-2.jpg');
        }
        .custom-css{
            width: 700px;
            height: 550px;
            background: white;
            margin:auto;
            padding: 40px;
            margin-top:150px;
            border : 1px solid white;
            box-shadow: 5px 10px 18px gray;
        }
        .custom-texthead h2{
            font-size: 50px;
            color:blue;
            margin-bottom: 30px;
        }
        .custom-btn{
            text-align: center;
            margin-top: 20px;
        }
        .custom-btn button{
            margin: 20px 20px 15px 20px;
            width: 150px;
            height: 60px;
            background:blue
        }
    </style> 
</head>
<body>
<?php
    require_once ('ConnectDatabase.php');
    if(isset($_POST['submit']) && $_POST['email'] != "" && $_POST['pass'] != "" && $_POST['repass'] != ""){
        $tb="";
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $repass=$_POST['repass'];
        if($pass != $repass){
            $tb="Mật khẩu không khớp";
        }else{
            $sql='select * from nhanvien where email="'.$email.'"';
            $count=mysqli_query($conn,$sql);
            if(mysqli_num_rows($count)>0){
                $tb="Tài khoản này đã tồn tại";
                echo"<script>";
                echo"alert('$tb')";
                echo"</script>";
            }else{
                $tb="Đăng kí thành công";
                echo"<script>";
                echo"alert('$tb')";
                echo"</script>";
                $sql1="INSERT INTO nhanvien VALUES(null,'".$email."','".$pass."')";
                mysqli_query($conn,$sql1);
                
                
                header("LOCATION:index.php");
                
            }
        }
        echo $tb;
    }
?>
<form action="" method="post">
<div class="container">
    <div class="panel panel-primary custom-css">
        <div class="panel-heading custom-texthead">
            <h2 class="text-center">
                SignUp
            </h2>
        </div>
        <div class="panel-body ">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Mật khẩu:</label>
                <input required="true" type="password" class="form-control" id="pass" name="pass">
            </div>
            <div class="form-group">
                <label for="pwd">Nhập lại mật khẩu:</label>
                <input required="true" type="password" class="form-control" id="repass" name="repass">
            </div>
            <div class="custom-btn">
                <button class="btn btn-success" type="submit" name="submit">Đăng kí</button><br>
                <a href="DangNhap.php">Quay lại đăng nhập nếu bạn có tài khoản</a>
            </div>
        </div>
    </div>
</div>
</form>
</body>
</html>