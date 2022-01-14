<?php
    include ("header'.php");
    include ("LeftMenu.php");
    require_once ('ConnectDatabase.php');

?>
<form action="" method="post">
    <div class="container">
            <h3 class="text-center">Nhập mã hóa đơn cần tìm </h3><br>
             <input type="text" class="form-control" name="a" id="a" placeholder="Nhập thông tin....">
             <input type="submit" value="Tìm kiếm" style="background: #c6ff00;margin-top: 10px">
    </div>
    <div class="container" style="max-width: 86%;margin-right: 0px">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h3>Kết quả tìm kiếm</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <table class="table table-condensed table-bordered table-hover">
                                <thead>
                                <tr class="text-center">
                                    <th>Mã Hóa Đơn</th>
                                    <th>Số thuê bao</th>
                                    <th>Tiền SMS</th>
                                    <th>Tiền Internet</th>
                                    <th>Tiền Cước Gọi</th>
                                    <th>VAT (10%)</th>
                                    <th>Tổng Tiền (VND)</th>
                                    <th>Trạng Thái</th>
                                    <th>Ngày Tạo</th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($_POST['a'])){
                                $tim = addslashes($_POST['a']);
                                $sql="SELECT * FROM hoadon where SoThueBao = '$tim'";
                                $query=mysqli_query($conn,$sql);
                                while($row=mysqli_fetch_array($query)){
                                    ?>
                                    <tr class="text-center">
                                        <td ><?php echo $row['MaHoaDon'];?></td>
                                        <td ><?php echo $row['SoThueBao'];?></td>
                                        <td><?php echo $row['TienSMS'];?></td>
                                        <td><?php echo $row['TienInternet'];?></td>
                                        <td><?php echo $row['TienCuocGoi'];?></td>
                                        <td ><?php echo $row['VAT'];?></td>
                                        <td ><?php echo $row['TongTien'];?></td>
                                        <?php
                                        $trangthai=$row['TrangThai'];
                                        if($trangthai == 0){
                                            echo ' <td > <a href="ThanhToan.php?id='.$row['MaHoaDon'].'"><button class="btn btn-sm btn-outline-danger" type="button" data-id="">Chưa thanh toán</button></a></td>';
                                        }
                                        else{
                                            echo '  <td > <a href="ThanhToan.php?id='.$row['MaHoaDon'].'"><button class="btn btn-sm btn-outline-danger" type="button" data-id="">Đã thanh toán</button></a></td>';
                                        }
                                        ?>
                                        <td ><?php echo $row['NgayTao'];?></td>
                                       
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

</form>
