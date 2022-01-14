<?php
include ("header'.php");
include ("LeftMenu.php");
include ("ConnectDatabase.php");
$sql="SELECT * FROM sms";
$query=mysqli_query($conn,$sql);
?>
<div class="container" style="max-width: 86%;margin-right: 0px">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Quản lý SMS</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="SMS_Them.php" >
					<i class="fa fa-plus"></i> Thêm mới</a></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover" id="list">
                            <thead>
                            <tr class="text-center">
                                <th>Mã gói SMS</th>
                                <th>Tên gói SMS</th>
                                <th>Phí SMS (VND)</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row=mysqli_fetch_array($query)){
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $row['MaSMS'];?></td>
                                    <td><?php echo $row['TenGoiSMS'];?></td>
                                    <td ><?php echo $row['PhiSMS'];?></td>
                                    <td class="text-center">
                                        <a href="SMS_Sua.php?id=<?php echo $row['MaSMS'];?>"><button class="btn btn-sm btn-outline-primary edit_fees" type="button" >Sửa thông tin</button></a>
                                        <a href="SMS_Xoa.php?id=<?php echo $row['MaSMS'];?>"><button class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có muốn xóa gói cước này không?')" type="button"  >Xóa thông tin</button></a>
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

