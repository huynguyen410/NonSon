<?php
session_start();
require './DataProvider.php';

$sql = "SELECT * FROM Loai_sanpham";
if (isset($_GET['MA_LOAI'])) {
    $sql = $sql . " WHERE `MA_LOAI` like '%" . $_GET['MA_LOAI'] . "%'";
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
                    <h1 class="h3 mb-4 text-gray-800">Loại sản phẩm</h1>

                </div>
                <!-- /.container-fluid -->
                <!-- <div class="container-fluid"> -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row-reverse">
                        <!-- button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTypeProductModal">+ Thêm loại sản phẩm</button>
                    </div>
                    <!-- Modal -->
                    <div class=" modal fade" id="addTypeProductModal" tabindex="-1" role="dialog" aria-labelledby="addTypeProductModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Nhập thông tin loại sản phẩm
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- add product data -->
                                <div class="modal-body">
                                    <form class="needs-validation" method="post" action='productType_addBtn.php'>
                                        <div class="form-group">
                                            <label class="form-label" for="typeID">Mã Loại sản phẩm</label>
                                            <input class="form-control" type="text" name="typeID">
                                        </div>

                                        <div class="form-group">
                                            <label class=" form-label" for="productName">Tên Loại sản phẩm</label>
                                            <input class="form-control" type="text" name="productTypeName">
                                        </div>

                                        <div class="form-group">
                                            <label class=" form-label" for="productDetail">Chi tiết</label>
                                            <input class="form-control" type="text" name="productTypeDetail">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary" name="addTypeProduct">Lưu</button>
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
                                        <th>Tên Loại sản phẩm</th>
                                        <th>Chi Tiết</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_array()) {
                                            echo "<tr>";
                                            echo "<td width=100>" . $row['MA_LOAI'] . "</td>";
                                            echo "<td>" . $row['TEN_LOAI'] . "</td>";
                                            echo "<td width=700>" . $row['CHI_TIET'] . "</td>";
                                    ?>
                                            <td>
                                                <button type="button" class="btn btn-primary button" data-toggle="modal" data-target="#fixTypeProductModal" data-id="<?php echo $row['MA_LOAI'] ?>">
                                                    Sửa thông tin
                                                </button>
                                                <a href="productType_DeleteBtn.php?<?php echo "MA_LOAI=" . $row['MA_LOAI'] ?>">
                                                    <button type="button" class="btn btn-danger button">
                                                        Xoá
                                                    </button>
                                                </a>
                                            </td>
                                        <?php } ?>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- fix product Modal -->
                            <div class=" modal fade" tabindex="-1" role="dialog" aria-labelledby="fixTypeProduct" aria-hidden="true" id="edit-product-modal">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Sửa thông tin loại sản phẩm </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- fix product data -->
                                        <div class="modal-body">
                                            <form class="needs-validation" action='product_edit.php' id="productEdit-form">
                                                <div class="form-group">
                                                    <label class=" form-label" for="typeID">Loại sản phẩm</label>
                                                    <input class="form-control" type="text" name="typeID_edit" value="<?php echo ($typeID); ?>" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label class=" form-label" for="productID">Mã sản phẩm</label>
                                                    <input class="form-control" type="text" name="productID_edit" value="<?php echo ($productID); ?>" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label class=" form-label" for="productName">Tên sản phẩm</label>
                                                    <input class="form-control" type="text" name="productName_edit" value="<?php echo ($productName); ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label class=" form-label" for="color">Màu</label>
                                                    <input class="form-control" type="text" name="color_edit" value="<?php echo ($color); ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="price">Giá</label>
                                                    <input class="form-control" type="price" name="price_edit" value="<?php echo ($price); ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="remainingProducts">Số lượng</label>
                                                    <input class="form-control" type="remainingProducts" name="remainingProducts_edit" value="<?php echo ($remainingProducts); ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label class=" form-label" for="productStatus">Tình trạng sản phẩm</label>
                                                    <input class="form-control" type="text" name="productStatus_edit" value="<?php echo ($productStatus); ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="Image" class="form-label">Ảnh sản phẩm</label>
                                                    <input class="form-control" type="file" name="productImg_edit" onchange="preview()" value="<?php echo ($productImg); ?>">
                                                </div>
                                                <img id="frame1" src="" class="img-fluid">

                                                <div class="form-group">
                                                    <label class=" form-label" for="productDetail">Chi tiết</label>
                                                    <input class="form-control" type="text" name="productDetail_edit" value="<?php echo ($productDetail); ?>">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" name="updateProductBtn" id="updateProductBtn" onclick="reloadPage()">Lưu</button>

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
                window.location.reload()
            }
        </script>

</body>

</html>