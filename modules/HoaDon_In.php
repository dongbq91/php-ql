
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<form style="color: #ff0000">
    <h2 style="text-align: center;color: red">HÓA ĐƠN THANH TOÁN PHÍ CƯỚC Vietteltelecom</h2>
    <p style="text-align: center">Địa chỉ chi nhánh: 67 Cầu Diễn, Nam Từ Liêm, Hà Nội</p>
    <div><button class="btn btn-outline-success" style="float: right;margin-right: 100px" id="in" onclick="window.print()">In hóa đơn</button></div>
    <div style="margin-left: 100px;margin-right: 100px">
        <?php
            session_start();
            if(isset($_GET['id']))
            {
                $_SESSION['id']=$_GET['id'];
            }
            require_once ("ConnectDatabase.php");
            $sql='SELECT * FROM hoadon where MaHoaDon="'.$_SESSION['id'].'"';
            $query=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($query)){
        ?>
        <p style="font-weight:bolder">Mã hóa đơn:<label style="margin-left: 20px"><?php echo $row['MaHoaDon'];?></label></p>
        <p style="font-weight:bolder">Tên khách hàng:<label style="margin-left: 20px"><?php
                $a='select *from khachhang inner join thuebao on khachhang.SoChungMinh=thuebao.SoChungMinh inner join hoadon on hoadon.SoThueBao=thuebao.SoThueBao where hoadon.MaHoaDon="'.$_SESSION['id'].'"';
                $query1=mysqli_query($conn,$a);
                $row1=mysqli_fetch_array($query1);
                echo $row1['TenKhachHang'];
        ?></label></p>
        <p style="font-weight:bolder">Số thuê bao:<label style="margin-left: 20px"><?php echo $row['SoThueBao'];?></label></p>
        <p style="font-weight:bolder">Ngày tạo hóa đơn:<label style="margin-left: 20px"><?php echo $row['NgayTao'];?></label></p>
        <p style="font-weight:bolder">Hình thức thanh toán:<label style="margin-left: 20px;font-weight: normal"> Chuyển khoản/Tiền mặt</label></p>
        <table class="table table-bordered" style="color: red;text-align: center">
            <tr>
                <th>Tiền SMS</th>
                <th>Tiền Internet</th>
                <th>Tiền Cước Gọi</th>
                <th>Thành tiền</th>
            </tr>
            <tr style="color: #000000">
                <td><?php echo $row['TienSMS'];?></td>
                <td><?php echo $row['TienCuocGoi'];?></td>
                <td><?php echo $row['TienInternet'];?> </td>
                <td><?php
                    $s=$row['TienSMS']+$row['TienCuocGoi']+$row['TienInternet'];
                    echo $s;
                    ?> <label>VND</label></td>
            </tr>

            <tr>
                <td colspan="3">Phí VAT (10%)</td>
                <td><?php echo $row['VAT'];?> <label>VND</label></td>
            </tr>
            <tr>
                <td colspan="3">Tổng tiền</td>
                <td><?php echo $row['TongTien'];?> <label>VND</label></td>
            </tr>
        </table>
            <?php } ?>
    </div>

</form>
<div style="font-weight: bolder;color: red;margin-left: 200px" >
    <span >Người nộp tiền kí</span>
    <span style="margin-left: 300px">Nhân viên giao dịch</span>
</div>
<div style="margin-left: 210px" >
    <span >(Kí rõ họ tên)</span>
    <span style="margin-left: 350px">(Kí rõ họ tên)</span>
</div>

</body>
</html>
