<?php
    include ("header'.php");
    include ("LeftMenu.php");
    include ("ConnectDatabase.php");
    $sql="SELECT * FROM thuebao ";
    $query=mysqli_query($conn,$sql);
    function xoa($id){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_name="btl_php";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password,$db_name);

}
?>
<div class="container" style="max-width: 86%;margin-right: 0px">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Quản lý thuê bao</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="ThueBao_Them.php" id="new_custom">
					<i class="fa fa-plus"></i> Thêm mới</a></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover" id="list">
                            <thead>
                            <tr class="text-center">
                                <th>Số thuê bao</th>
                                <th>Ngày kích hoạt</th>
                                <th>Số chứng minh</th>
                                <th> Tên khách hàng </th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row=mysqli_fetch_array($query)){
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $row['SoThueBao'];?></td>
                                    <td><?php echo $row['NgayKichHoat'];?></td>
                                    <td ><?php echo $row['SoChungMinh'];?></td>
                                    <td><?php 
                                        $sql = "select * from Khachhang where SoChungMinh = '".$row['SoChungMinh']."' ";
                                        $name = mysqli_query($conn,$sql);
                                        while($row1 = mysqli_fetch_array($name)){
                                            echo $row1['TenKhachHang'];
                                        }
                                    ?> 
                                    <td class="text-center">
                                        <a href="ThueBao_Sua.php?id=<?php echo $row['SoThueBao']?>"><button class="btn btn-sm btn-outline-primary edit_fees" type="button" >Sửa thông tin</button></a>
                                        <a href="ThueBao_Xoa.php?id=<?php echo $row['SoThueBao']?>"><button class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có muốn xóa thuê bao này không?')" type="button"  >Xóa thông tin</button></a>
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

