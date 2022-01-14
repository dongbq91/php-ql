
<?php
    include ("header'.php");
    include ("LeftMenu.php");
    require_once ('ConnectDatabase.php');

?>
<form action="" method="post">
    <div class="container">
            <h3 class="text-center">Nhập mã khách hàng cần tìm </h3><br>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                        <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="KhachHang_Them.php" id="new_custom">
					<i class="fa fa-plus"></i> Thêm mới</a></span>
                </div>
                <div class="card-body">
                    <table class="table table-condensed table-bordered table-hover" id="list">
                        <thead>
                        <tr class="text-center">
                            
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Số chứng minh</th>
                            <th>Giới tính</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($_POST['a'])){
                            $tim = addslashes($_POST['a']);
                            $sql="SELECT * FROM khachhang where TenKhachHang like '%$tim%'";
                            $query=mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_array($query)){
                            ?>
                            <tr class="text-center">
                                
                                <td><?php echo $row['TenKhachHang'];?></td>
                                <td><?php echo $row['DiaChi'];?></td>
                                <td><?php echo $row['SoChungMinh'];?></td>
                                <td><?php
                                    $gioitinh=$row['GioiTinh'];
                                    if($gioitinh == 0){
                                        echo "Nữ";
                                    }else if($gioitinh == 1){
                                        echo "Nam";
                                    }
                                    ?></td>
                                <td class="text-center">
                                    <a href="KhachHang_Sua.php?id=<?php echo $row['SoChungMinh']?>"><button class="btn btn-sm btn-outline-primary edit_fees" type="button" >Sửa thông tin</button></a>
                                    <button class="btn btn-sm btn-outline-danger delete_fees" type="button" onclick="deleteKhachHang(<?php echo $row['SoChungMinh']?>)" >Xóa thông tin</button>
                                </td>
                            </tr>
                        <?php } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>

    </div>

</form>
