<?php
include ("header'.php");
include ("LeftMenu.php");
include ("ConnectDatabase.php");
$sql="SELECT * FROM hoadon where TrangThai=1";
$query=mysqli_query($conn,$sql);
?>
<div class="container" style="max-width: 86%;margin-right: 0px">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <h2>Thống kê doanh thu</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  " style="width: 100%;height: auto" >

                    <div class="card-body" style="display:flex" >

                       <div style="width: 40%;height: 25%"><canvas id="myChart" style="width:40%"></canvas></div>
                       <div style="width: 40%;height: 25%"><canvas id="myChart1" style="width:40%"></canvas></div>
                    </div>

                </div>
                <div class="card  " style="width: 100%;height: auto" >

                    <div class="card-body"  >
                        <div style="width: 100%;height: 25%;max-width: 800px"><canvas id="myChart2" ></canvas></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $sql = "select * from HoaDon";
    $list = mysqli_query($conn,$sql);
    $tienthang1=0;$tienthang2=0;$tienthang3=0;$tienthang4=0;$tienthang5=0;$tienthang6=0;$tienthang7=0;$tienthang8=0;$tienthang9=0;$tienthang10=0;$tienthang11=0;$tienthang12=0;
    while($row = mysqli_fetch_array($list)){
       $ngay = $row['NgayTao'];
       $arr = explode("-",$ngay);
       $thang = $arr[1];

       if($thang == 1 ){
           $tienthang1 = $tienthang1 + $row['TongTien'];
       }
       if($thang == 2 ){
           $tienthang2 = $tienthang2 + $row['TongTien'];
       }
       if($thang == 3 ){
           $tienthang3 = $tienthang3 + $row['TongTien'];
       }
       if($thang == 4 ){
           $tienthang4 = $tienthang4 + $row['TongTien'];
       }
       if($thang == 1 ){
           $tienthang5 = $tienthang5 + $row['TongTien'];
       }
       if($thang == 6 ){
           $tienthang6 = $tienthang6 + $row['TongTien'];
       }
       if($thang == 7 ){
           $tienthang7 = $tienthang7 + $row['TongTien'];
       }
       if($thang == 8 ){
           $tienthang8 = $tienthang8 + $row['TongTien'];
       }
       if($thang == 9 ){
           $tienthang9 = $tienthang9 + $row['TongTien'];
       }
       if($thang == 10 ){
           $tienthang10 = $tienthang10 + $row['TongTien'];
       }
       if($thang == 11 ){
           $tienthang11 = $tienthang11 + $row['TongTien'];
       }
       if($thang == 12 ){
           $tienthang12 = $tienthang12 + $row['TongTien'];
       }
    }

    echo '<script>
            var xValues = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
            var yValues = ['.$tienthang1.', '.$tienthang2.', '.$tienthang3.', '.$tienthang4.', '.$tienthang5.','.$tienthang6.','.$tienthang7.','.$tienthang8.','.$tienthang9.','.$tienthang10.','.$tienthang11.','.$tienthang12.'];
            var barColors = ["red", "green","blue","orange","brown", "green", "green", "green", "green", "green", "green", "green"];
            
            new Chart("myChart2", {
              type: "bar",
              data: {
                labels: xValues,
                datasets: [{
                  backgroundColor: barColors,
                  data: yValues
                }]
              },
              options: {
                legend: {display: false},
                title: {
                  display: true,
                  text: "Thống kê doanh thu theo từng tháng"
                }
              }
            });
            </script>'
?>
<?php
            $data = array();
            $query = "SELECT TienSMS,TienCuocGoi,TienInternet FROM HoaDon ";
            $list = mysqli_query($conn,$query);
            $tiensms=0;
            $tieninternet=0;
            $tiengoi=0;
            while($row = mysqli_fetch_array($list)){
                $tiengoi = $tiengoi + $row['TienCuocGoi'];
                $tieninternet = $tieninternet + $row['TienInternet'];
                $tiensms = $tiensms+ $row['TienSMS'];
            }

       echo '<script>
            var xValues = ["Tiền SMS", "Tiền Internet", "Tiền cước gọi"];
            var yValues = ['.$tiensms.', '.$tieninternet.','.$tiengoi.'];
            var barColors = [
              "#b91d47",
              "#00aba9",
              "#2b5797",
            ];
            
            new Chart("myChart1", {
              type: "pie",
              data: {
                labels: xValues,
                datasets: [{
                  backgroundColor: barColors,
                  data: yValues
                }]
              },
              options: {
                title: {
                  display: true,
                  text: "Doanh thu các dịch vụ (VND)"
                }
              }
            });
            </script>'
?>
<script>
    $(document).ready(function () {
        showGraph();
        // showGraph1();
    });


    function showGraph(){
        $.post("ThongKe_Data.php",
            function (data){
                var labels = [];
                var result = [];
                for (var i in data) {
                    labels.push(data[i].TrangThai);
                    result.push(data[i].size_status);
                }
                var pie = $("#myChart");
                var myChart = new Chart(pie, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                data: result,
                                borderColor: ["rgba(217, 83, 79,1)","rgba(240, 173, 78, 1)","rgba(92, 184, 92, 1)"],
                                backgroundColor: ["rgba(217, 83, 79,0.2)","rgba(240, 173, 78, 0.2)","rgba(92, 184, 92, 0.2)"],
                            }
                        ]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Khách hàng thanh toán"
                        }
                    }
                });
            });
    }
    // function showGraph1(){
    //     $.post("ThongKe_Data1.php",
    //         function (data){
    //             var a = ["Tiền SMS","Tiền Internet","Tiền cước gọi"];
    //             var labels = [];
    //             for(var  i in a){
    //                 labels.push(a[i]);
    //             }
    //             var result = [];
    //             for (var i in data) {
    //                 result.push(data[i]);
    //             }
    //             var pie = $("#myChart1");
    //             var myChart = new Chart(pie, {
    //                 type: 'pie',
    //                 data: {
    //                     labels: labels,
    //                     datasets: [
    //                         {
    //                             data: result,
    //                             borderColor: ["rgba(217, 83, 79,1)","rgba(240, 173, 78, 1)","rgba(92, 184, 92, 1)"],
    //                             backgroundColor: ["rgba(217, 83, 79,0.2)","rgba(240, 173, 78, 0.2)","rgba(92, 184, 92, 0.2)"],
    //                         }
    //                     ]
    //                 },
    //                 options: {
    //                     title: {
    //                         display: true,
    //                         text: "Trạng thái khách hàng thanh toán"
    //                     }
    //                 }
    //             });
    //         });
    // }
</script>
<script type="text/javascript">

</script>
