<?php
    include ("header'.php");
    include ("LeftMenu.php");
    include ("ConnectDatabase.php");
    $sql="SELECT * FROM chitietcuocgoi";
    $query=mysqli_query($conn,$sql);
?>
<div class="container" style="max-width: 86%;margin-right: 0px">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Chi tiết giao dịch cước gọi</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="GiaoDichCuocGoi_Them.php" >
					<i class="fa fa-plus"></i> Thêm mới</a></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover" id="list">
                            <thead>
                            <tr class="text-center">
                                <th>Số thuê bao</th>
                                <th>Tên gói cước</th>
                                <th>Số điện thoại gọi</th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian kết thúc</th>
                                <th>Tổng tiền</th>
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
                                        $query1="select cuocgoi.TenCuocGoi from cuocgoi inner join chitietcuocgoi on cuocgoi.MaCuocGoi = chitietcuocgoi.MaCuocGoi where chitietcuocgoi.id_cuocgoi='".$row['id_cuocgoi']."' ";
                                        $list= executeResult($query1);
                                        foreach ($list as $item){
                                            echo $item['TenCuocGoi'];
                                        }
                                        ?></td>
                                    <td ><?php echo $row['SDT_goi'];?></td>
                                    <td ><?php echo $row['TG_BD'];?></td>
                                    <td ><?php echo $row['TG_KT'];?></td>
                                    <td ><?php echo $row['TongTienGoi'];?></td>

                                    <td class="text-center"><a href="GiaoDichCuocGoi_Xoa.php?id=<?php echo $row['id_cuocgoi'];?>"><button class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có muốn xóa chi tiết giao dịch này không?')" type="button"  >Xóa thông tin</button></a>
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

