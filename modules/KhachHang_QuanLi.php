<?php
include ("header'.php");
include ("LeftMenu.php");
include ("ConnectDatabase.php");
    $sql="SELECT * FROM khachhang ORDER BY TenKhachHang ASC";
    $query=mysqli_query($conn,$sql);
?>
<div class="container" style="max-width: 86%;margin-right: 0px">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Quản lý khách hàng</h2>
            </div>
        </div>
        <div class="row">
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
                                <th>Email</th>
                                <th>Ảnh đại diện</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
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
                                <td><?php echo $row['gmail'];?></td>
                                <td><?php echo "<img src='../image/".$row['anh']."' width='100' height='150' >";;?></td>
                                <td class="text-center">
                                    <a href="KhachHang_Sua_1.php?id=<?php echo $row['SoChungMinh']?>"><button class="btn btn-sm btn-outline-primary edit_fees" type="button" >Sửa thông tin</button></a>
                                    <button class="btn btn-sm btn-outline-danger delete_fees" type="button" onclick="deleteKhachHang(<?php echo $row['SoChungMinh']?>)" >Xóa thông tin</button>
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

<script type="text/javascript">
    function deleteKhachHang(id) {
        var option = confirm('Bạn có chắc chắn muốn xoá khách hàng này không?')
        if(!option) {
            return;
        }

        console.log(id)
        //ajax - lenh post
        $.post('KhachHang_Xoa.php', {
            'id': id,
            'action': 'delete'
        }, function(data) {
            location.reload()
        })
    }
</script>