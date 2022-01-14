<?php
    session_start();
    include ("header'.php");
    include ("LeftMenu.php");
    include ("ConnectDatabase.php");
    $sql="SELECT * FROM hoadon ";
    $query=mysqli_query($conn,$sql);
?>
<div class="container" style="max-width: 86%;margin-right: 0px">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Thanh Toán Hóa Đơn</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="HoaDon_Them.php">
					<i class="fa fa-plus"></i> Thêm hóa đơn</a></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th>Số thuê bao</th>
                                <th>Tiền SMS</th>
                                <th>Tiền Internet</th>
                                <th>Tiền Cước Gọi</th>
                                <th>VAT (10%)</th>
                                <th>Tổng Tiền (VND)</th>
                                <th>Trạng Thái</th>
                                <th>Ngày Tạo</th>
                                <th>Thao Tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row=mysqli_fetch_array($query)){
                                ?>
                                <tr class="text-center">
                                    <td ><?php echo $row['SoThueBao'];?></td>
                                    <td><?php echo $row['TienSMS'];?></td>
                                    <td><?php echo $row['TienInternet'];?></td>
                                    <td><?php echo $row['TienCuocGoi'];?></td>
                                    <td ><?php echo $row['VAT'];?></td>
                                    <td ><?php echo $row['TongTien'];?></td>
                                    <?php
                                    $trangthai=$row['TrangThai'];
                                    if($trangthai == 0){
                                        echo ' <td > <a href="ThongKe_ThanhToan.php?id='.$row['MaHoaDon'].'"><button class="btn btn-sm btn-outline-info" type="button" data-id="">Chưa thanh toán</button></a></td>';
                                    }
                                    else{
                                        echo '  <td > <a href="ThongKe_ThanhToan.php?id='.$row['MaHoaDon'].'"><button class="btn btn-sm btn-outline-danger" type="button" data-id="">Đã thanh toán</button></a></td>';
                                    }
                                    ?>
                                    <td ><?php echo $row['NgayTao'];?></td>
                                    <td class="text-center" >
                                        <a href="HoaDon_In.php?id=<?php echo $row['MaHoaDon']?>"><button class="btn btn-sm btn-outline-danger" type="button" data-id="">In hóa đơn</button><br></a>
                                        <a href="HoaDon_Xoa.php?id=<?php echo $row['MaHoaDon']?>"><button class="btn btn-sm btn-outline-success" onclick="return confirm('Bạn có muốn hóa đơn này không?')" type="button"  >Xóa hóa đơn</button></a><br>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
