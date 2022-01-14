<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập tài khoản</title>
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
            height: 500px;
            background: white;
            margin:auto;
            padding: 40px;
            margin-top:170px;
            border : 1px solid white;
        }
        .custom-texthead h2{
            font-size: 50px;
            color:blue;
            margin-bottom: 30px;
        }
        .custom-btn{
            text-align: center;
            margin-top: 50px;
        }
        .custom-btn button{
            margin: 20px;
            width: 150px;
            height: 60px;
            background:blue
        }
    </style>   
</head>
<body>
<?php
    require_once ('ConnectDatabase.php');
    if(isset($_POST['dangnhap'])){
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $sql = 'SELECT * FROM nhanvien WHERE email = "'.$email.'" AND password="'.$password.'"';
        $result = mysqli_query($conn,$sql);
        $demdong = mysqli_num_rows($result);
        if($demdong == 1)
        {
            $_SESSION['user']=$email;
            $arr = mysqli_fetch_assoc($result);
//            $name = $arr['tenkh'];
//            $_SESSION['taikhoan'] = $user;
//            $_SESSION['matkhau'] = $password;
//            $_SESSION['name'] = $name;
            header("LOCATION:index.php");
        }
        else
        {
            echo "<strong>Đăng nhập thất bại</strong>";
        }
    }
?>
<form method="post">
    <div class="container custom-container">
        <div class="panel panel-primary custom-css">
            <div class="panel-heading custom-texthead">
                <h2 class="text-center">Login</h2>
            </div>
            <div class="panel-body custom-body">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Mật khẩu:</label>
                    <input required="true" type="password" class="form-control" id="pass" name="pass">
                </div>
                <div class="custom-btn">
                    <button class="btn btn-success" type="submit" name="dangnhap">Đăng nhập</button>
                    <a href="DangKi.php"><button class="btn btn-success" type="button">Đăng kí</button></a>
                </div>
                
            </div>
        </div>
    </div>
</form>
</body>
</html>