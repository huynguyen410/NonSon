<?php
session_start();
require './DataProvider.php';

$sql = "SELECT * FROM sanpham";
if (isset($_GET['MA_SP'])) {
    $sql = $sql . " WHERE `MA_SP` like '%" . $_GET['MA_SP'] . "%'";
}
$result = executeQuery($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/product.css">
    <link href="css/modalbox.css">

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
                    <h1 class="h3 mb-4 text-gray-800">Sản phẩm</h1>

                </div>
                <!-- /.container-fluid -->
                <!-- <div class="container-fluid"> -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row-reverse">
                        <!-- button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">+ Thêm sản phẩm</button>
                    </div>
                    <!-- Modal -->
                    <div class=" modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Nhập thông tin sản phẩm
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- add product data -->
                                <div class="modal-body">
                                    <form class="needs-validation" method="post" action='product_addBtn.php' enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="form-label" for="typeID">Mã Loại sản phẩm</label>
                                            <select class="form-control" type="text" name="typeID">
                                                <option selected>Chọn mã loại sản phẩm ...</option>
                                                <option value="12F">12F (Nón 1/2 Đầu)</option>
                                                <option value="34F">34F (Nón 3/4 Đầu)</option>
                                                <option value="FF">FF (Nón FULLFACE)</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class=" form-label" for="productID">Mã sản phẩm</label>
                                            <input class="form-control" type="text" name="productID">
                                        </div>

                                        <div class="form-group">
                                            <label class=" form-label" for="productName">Tên sản phẩm</label>
                                            <input class="form-control" type="text" name="productName">
                                        </div>

                                        <div class="form-group">
                                            <label class=" form-label" for="color">Màu</label>
                                            <input class="form-control" type="text" name="color">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="price">Giá</label>
                                            <input class="form-control" type="number" name="price">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="remainingProducts">Số lượng</label>
                                            <input class="form-control" type="number" name="remainingProducts">
                                        </div>

                                        <!-- <div class="form-group">
                                                <label class=" form-label" for="productStatus">Tình trạng sản phẩm</label>
                                                <input class="form-control" type="boolean" name="productStatus">
                                            </div> -->

                                        <div class="form-group">
                                            <label for="Image" class="form-label">Ảnh sản phẩm</label>
                                            <input class="form-control" type="file" name="productImg" id="productImg" onchange="preview()">
                                            <!-- <button onclick="clearImage()" class="btn btn-outline-primary mt-3">xoá ảnh</button> -->
                                        </div>
                                        <img id="frame" src="" class="img-fluid" />

                                        <div class="form-group">
                                            <label class=" form-label" for="productDetail">Chi tiết</label>
                                            <input class="form-control" type="text" name="productDetail">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary" name="addProduct">Lưu</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- data table -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered danhsach" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Mã Loại</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Màu</th>
                                        <th>Giá (VNĐ)</th>
                                        <th>Số Lượng</th>
                                        <!-- <th>Tình trạng sản phẩm</th> -->
                                        <th>Hình ảnh</th>
                                        <th class="w-27">Chi Tiết</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_array()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['MA_LOAI'] . "</td>";
                                            echo "<td>" . $row['MA_SP'] . "</td>";
                                            echo "<td>" . $row['TEN_SP'] . "</td>";
                                            echo "<td>" . $row['MAU'] . "</td>";
                                            echo "<td>" . $row['GIA'] . "</td>";
                                            echo "<td>" . $row['SO_LUONG'] . "</td>";
                                            // echo "<td>" . $row['TINH_TRANG_SP'] . "</td>";
                                            // echo "<td>" . $row['HINH_ANH'] . "</td>";
                                            echo "<td ><img src='../" . $row["HINH_ANH"] . "' width=200px></td>";
                                            echo "<td>" . $row['CHI_TIET'] . "</td>";

                                    ?>
                                            <td width="250">
                                                <button type="button" class="btn btn-primary button" data-toggle="modal" data-target="#fixProductModal" data-id="<?php echo $row['MA_SP'] ?>">
                                                    Sửa thông tin
                                                </button>
                                                <?php
                                                $params = "MA_SP=" . $row['MA_SP'];
                                                if ($row['TINH_TRANG_SP'] == '1') {
                                                    $class_button = 'success';
                                                    $class_svg = 'lock';
                                                    $class_path = 'M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z';
                                                    $text = 'Đang bán';
                                                    $params .= '&TINH_TRANG_SP=0';
                                                } else {
                                                    $class_button = 'danger';
                                                    $class_svg = 'unlock';
                                                    $class_path = 'M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z';
                                                    $text = 'Đang Ẩn';
                                                    $params .= '&TINH_TRANG_SP=1';
                                                }
                                                ?>
                                                <a href="product_update_status.php?<?php echo $params ?>">
                                                    <button type="button" class="btn btn-outline-<?php echo $class_button ?> btn-toggle-active-account" id="#lockBtn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-<?php echo $class_svg ?>" viewBox="0 0 16 16">
                                                            <path d="<?php echo $class_path ?>" />
                                                        </svg>
                                                        <?php echo $text ?>
                                                    </button>
                                                </a>
                                                <?php
                                                if ($row['TINH_TRANG_SP'] == '0') { ?>
                                                    <a href="product_DeleteBtn.php?<?php echo "MA_SP=" . $row['MA_SP'] ?>">
                                                        <button type="button" class="btn btn-danger button" id="Delete" onclick="return confirm('Bạn có chắc chắn muốn xoá không ?')">
                                                            Xoá sản phẩm
                                                        </button>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- fix product Modal -->
                            <div class=" modal fade" tabindex="-1" role="dialog" aria-labelledby="fixProduct" aria-hidden="true" id="fixProductModal">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Sửa thông tin sản
                                                phẩm </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- fix product data -->
                                        <div class="modal-body">
                                            <form class="needs-validation" action='product_edit.php' id="productEdit-form">
                                                <div class="form-group">
                                                    <label class=" form-label" for="typeID">Loại sản phẩm</label>
                                                    <input class="form-control" type="text" name="typeID_edit" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label class=" form-label" for="productID">Mã sản phẩm</label>
                                                    <input class="form-control" type="text" name="productID_edit"  readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label class=" form-label" for="productName">Tên sản phẩm</label>
                                                    <input class="form-control" type="text" name="productName_edit" >
                                                </div>

                                                <div class="form-group">
                                                    <label class=" form-label" for="color">Màu</label>
                                                    <input class="form-control" type="text" name="color_edit" >
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="price">Giá</label>
                                                    <input class="form-control" type="price" name="price_edit">
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="remainingProducts">Số lượng</label>
                                                    <input class="form-control" type="remainingProducts" name="remainingProducts_edit">
                                                </div>

                                                <!-- <div class="form-group">
                                                    <label class=" form-label" for="productStatus">Tình trạng sản phẩm</label>
                                                    <input class="form-control" type="text" name="productStatus_edit" value="">
                                                </div> -->

                                                <div class="form-group">
                                                    <label for="Image" class="form-label">Ảnh sản phẩm</label>
                                                    <input class="form-control" type="file" name="productImg_edit" onchange="preview()">
                                                </div>
                                                <img id="frame1" src="" class="img-fluid">

                                                <div class="form-group">
                                                    <label class=" form-label" for="productDetail">Chi tiết</label>
                                                    <input class="form-control" type="text" name="productDetail">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <button type="button" class="btn btn-primary" name="updateProductBtn" id="updateProductBtn">Lưu</button>

                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="Ban Non text-center my-auto">
                        <span>Bán Nón </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

        <script src="./js/productEdit_scripts.js"></script>

        <!-- add picture -->
        <script>
            function preview() {
                frame.src = URL.createObjectURL(event.target.files[0]);
            }

            function clearImage() {
                document.getElementById('productImg').value = window.history(-1);
                frame.src = "";
            }

            function reloadPage() {
                // window.location.reload()
            }
        </script>

</body>

</html>