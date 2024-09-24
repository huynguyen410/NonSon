<?php
session_start();
require './DataProvider.php';

$sql = "SELECT * FROM hoadon LEFT JOIN chitiet_hoadon ON hoadon.MA_HD = chitiet_hoadon.MA_HD";

if (isset($_GET['MA_HD'])) {
    $sql .= " WHERE hoadon.`MA_HD` LIKE '%" . $_GET['MA_HD'] . "%'
              OR chitiet_hoadon.`MA_HD` LIKE '%" . $_GET['MA_HD'] . "%'";
}

if (isset($_GET['start_date']) || isset($_GET['end_date']) || isset($_GET['dia_chi']) || isset($_GET['trang_thai'])) {
    $sql = "SELECT * FROM hoadon LEFT JOIN chitiet_hoadon ON hoadon.MA_HD = chitiet_hoadon.MA_HD WHERE 1=1 ";
    if (!empty($_GET['start_date'])) {
        $start_date = $_GET['start_date'];
        $sql .= " AND NGAY_TAO_HD >= '$start_date'";
    }
    if (!empty($_GET['dia_chi'])) {
        $dia_chi = $_GET['dia_chi'];
        $sql .= " AND DIA_CHI_NHAN LIKE '%$dia_chi%'";
    }
    if (!empty($_GET['trang_thai'])) {
        $trang_thai = $_GET['trang_thai'];
        $sql .= " AND TRANG_THAI = $trang_thai";
    }
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đơn Hàng</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/product.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'Sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'topbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-row bd-highlight justify-content-between">
                    <h1 class="h3 mb-4 text-gray-800">Đơn hàng</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered danhsach" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã hoá đơn</th>
                                            <th>Ngày đặt</th>
                                            <th>Tài khoản mua</th>
                                            <th>Tên người nhận</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Địa chỉ</th>
                                            <th>Giá (VNĐ)</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền (VNĐ)</th>
                                            <th>Tình trạng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_array()) {
                                                echo "<tr>";
                                                echo "<td>" . $row['MA_HD'] . "</td>";
                                                echo "<td>" . $row['NGAY_TAO_HD'] . "</td>";
                                                echo "<td>" . $row['USERNAME'] . "</td>";
                                                echo "<td>" . $row['TEN_NGUOI_NHAN'] . "</td>";
                                                echo "<td>" . $row['MA_SP'] . "</td>";
                                                echo "<td>" . $row['DIA_CHI_NHAN'] . "</td>";
                                                echo "<td>" . $row['GIA'] . "</td>";
                                                echo "<td>" . $row['SOLUONG'] . "</td>";
                                                echo "<td>" . $row['THANH_TIEN'] . "</td>";
                                                if ($row['TRANG_THAI'] == 0) {
                                                    echo "<td>Chưa xử lý</td>";
                                                } elseif ($row['TRANG_THAI'] == 1) {
                                                    echo "<td>Đã xử lý</td>";
                                                } else {
                                                    echo "<td>Không xác định</td>";
                                                }
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='10' style='text-align:center'>Không có dữ liệu</td></tr>";
                                        }
                                        ?>
                                    </tbody>

                                    <!--- form lọc ngày, địa chỉ nhận, trạng thái --->
                                    <form action="order.php" method="GET">
                                        <div class="form-group">
                                            <label for="start_date">Từ ngày:</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date">
                                        </div>
                                        <div class="form-group">
                                            <label for="dia_chi">Địa chỉ nhận:</label>
                                            <input type="text" class="form-control" id="dia_chi" name="dia_chi">
                                        </div>
                                        <div class="form-group">
                                            <label for="trang_thai">Trạng thái:</label>
                                            <select class="form-control" id="trang_thai" name="trang_thai">
                                                <option value="">Tất cả</option>
                                                <option value="0">Chưa xử lý</option>
                                                <option value="1">Đã xử lý </option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Lọc</button>
                                    </form>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="Ban Non text-center my-auto">
                        <span>NON SON</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn đăng xuất ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Chọn nút "Đăng xuất" nếu bạn muốn thoát khỏi trang này</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Quay lại</button>
                        <a class="btn btn-primary" href="adminLogin.php">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

</body>

</html>