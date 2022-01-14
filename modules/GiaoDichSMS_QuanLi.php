<?php
    include ("header'.php");
    include ("LeftMenu.php");
    include ("ConnectDatabase.php");
    $sql="SELECT * FROM chitietsms";
    $query=mysqli_query($conn,$sql);
?>
<div class="container" style="max-width: 86%;margin-right: 0px">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Chi tiết giao dịch SMS</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="GiaoDichSMS_Them.php" >
					<i class="fa fa-plus"></i> Thêm mới</a></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover" id="list">
                            <thead>
                            <tr class="text-center">
                                <th>Số thuê bao</th>
                                <th>Tên gói SMS</th>
                                <th>Thời gian</th>
                                <th>Phí cước SMS</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row=mysqli_fetch_array($query)){
                                ?>
                                <tr class="text-center">
                                    <td ><?php echo $row['SoThueBao'];?></td>
                                    <td><?php
                                        $query1="select sms.TenGoiSMS from sms inner join chitietsms on sms.MaSMS = chitietsms.MaSMS where chitietsms.id_sms='".$row['id_sms']."' ";
                                        $list= executeResult($query1);
                                        foreach ($list as $item){
                                            echo $item['TenGoiSMS'];
                                            }

                                        ?></td>
                                    <td ><?php echo $row['ThoiGian'];?></td>
                                    <td ><?php echo $row['PhiSMS'];?></td>
                                    <td class="text-center"><a href="GiaoDichSMS_Xoa.php?id=<?php echo $row['id_sms'];?>"><button class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có muốn xóa chi tiết giao dịch này không?')" type="button"  >Xóa thông tin</button></a>
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

