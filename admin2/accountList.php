<?php
session_start();
require './DataProvider.php';

$sql = "SELECT * FROM taikhoan";
if (isset($_GET['USERNAME'])) {
    $sql = $sql . " WHERE `USERNAME` like '%" . $_GET['Username'] . "%'";
}
$result = executeQuery($sql);

$name = $phoneNumber = $email = $address = $role = '';
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
                    <h1 class="h3 mb-4 text-gray-800">Danh Sách Tài Khoản</h1>

                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row-reverse">
                            <!-- button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">+ Thêm Tài Khoản</button>
                        </div>
                        <!-- Modal -->
                        <div class=" modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Nhập thông tin tài khoản
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <!-- add data -->
                                    <div class="modal-body">
                                        <form class="needs-validation" method="post" action='accountList_addBtn.php'>
                                            <div class="form-group">
                                                <label class="form-label" for="Username">Tên Đăng Nhập</label>
                                                <input class="form-control" type="Username" name="Username" id="Username">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="Password">Mật Khẩu</label>
                                                <input class="form-control" type="Password" name="Password" id="Password">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="Name">Tên người dùng</label>
                                                <input class="form-control" type="Name" name="Name" id="Name">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="phoneNumber">Số Điện Thoại</label>
                                                <input class="form-control" type="phoneNumber" name="phoneNumber" id="phoneNumber">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="email">Email</label>
                                                <input class="form-control" type="email" name="email" id="email">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="Address">Địa Chỉ</label>
                                                <input class="form-control" type="Address" name="Address" id="Address">
                                            </div>

                                            <!-- <div class="form-group">
                                                <label class="form-label" for="Role">Vai Trò (1 là admin / 0 là user)</label>
                                                <input class="form-control" type="Role" name="Role" id="Role">
                                            </div> -->

                                            <div class="form-group">
                                                <label class="form-label" for="Role">Vai Trò</label>
                                                <select class="form-control" type="Role" name="Role" id="Role">
                                                    <option value="selected">Vui Lòng chọn vai trò ...</option>
                                                    <option value="1">Admin</option>
                                                    <option value="0">User</option>
                                                </select>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary" name="add" onclick="reloadPage()">Thêm</button>
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
                                            <th>#</th>
                                            <th>Tên Đăng Nhập</th>
                                            <th>Tên Người Dùng</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Email</th>
                                            <th>Địa Chỉ</th>
                                            <th>Vai Trò</th>
                                            <th>Chức Năng</th>
                                        </tr>
                                    </thead>
                                    <tbody><?php
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                $i = 1;
                                                while ($row = $result->fetch_array()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $i++ . "</td>";
                                                    echo "<td>" . $row['USERNAME'] . "</td>";
                                                    echo "<td>" . $row['NAME'] . "</td>";
                                                    echo "<td>" . $row['PHONE_NUMBER'] . "</td>";
                                                    echo "<td>" . $row['EMAIL'] . "</td>";
                                                    echo "<td width=300>" . $row['ADDRESS'] . "</td>";
                                                    if ($row['ROLE'] == '1') {
                                                        echo "<td>" . 'Admin' . "</td>";
                                                    } else {
                                                        echo "<td>" . 'User' . "</td>";
                                                    }
                                            ?>
                                                <td width="350">
                                                    <button type="button" class="btn btn-primary button" data-toggle="modal" data-target="#fixAccountModal" data-id="<?php echo $row['USERNAME'] ?>">
                                                        Sửa thông tin
                                                    </button>
                                                    <?php
                                                    $params = "username=" . $row['USERNAME'];
                                                    if ($row['STATUS'] == '1') {
                                                        $class_button = 'success';
                                                        $class_svg = 'lock';
                                                        $class_path = 'M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z';
                                                        $text = 'Tài khoản còn hoạt động';
                                                        $params .= '&status=0';
                                                    } else {
                                                        $class_button = 'danger';
                                                        $class_svg = 'unlock';
                                                        $class_path = 'M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z';
                                                        $text = 'Tài khoản đang bị khoá';
                                                        $params .= '&status=1';
                                                    }
                                                    ?>
                                                    <a href="account_update_status.php?<?php echo $params ?>">
                                                        <button type="button" class="btn btn-outline-<?php echo $class_button ?> btn-toggle-active-account" id="#lockBtn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-<?php echo $class_svg ?>" viewBox="0 0 16 16">
                                                                <path d="<?php echo $class_path ?>" />
                                                            </svg>
                                                            <?php echo $text ?>
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

                                <div class=" modal fade" tabindex="-1" role="dialog" aria-labelledby="fixAccount" aria-hidden="true" id="fixAccountModal">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Sửa thông tin người dùng</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- fix product data -->
                                            <div class="modal-body">
                                                <form class="needs-validation" action='accountList_edit.php' id="edit-form">

                                                    <input class="form-control" type='text' name='Username_edit' value="<?php echo ($username); ?>" hidden>

                                                    <div class="form-group">
                                                        <label class="form-label" for="Name">Tên người dùng</label>
                                                        <input class="form-control" type="Name" name="Name_edit" value="<?php echo ($name); ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label" for="phoneNumber">Số Điện Thoại</label>
                                                        <input class="form-control" type="phoneNumber" name="phoneNumber_edit" value="<?php echo ($phoneNumber); ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input class="form-control" type="email" name="email_edit" value="<?php echo ($email); ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label" for="Address">Địa Chỉ</label>
                                                        <input class="form-control" type="Address" name="Address_edit" value="<?php echo ($address); ?>">
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label class="form-label" for="Role">Vai Trò (1 là admin / 0 là user)</label>
                                                        <input class="form-control" type="Role" name="Role_edit">
                                                    </div> -->

                                                    <div class="form-group">
                                                        <label class="form-label" for="Role">Vai Trò</label>
                                                        <select class="form-control" type="Role" name="Role_edit" value="<?php echo ($role); ?>">
                                                            <option value="1">Admin</option>
                                                            <option value="0">User</option>
                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary" name="updateBtn" id="btnUpdateSubmit" onclick="reloadPage()">Cập nhật</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <a class="btn btn-primary" href="admin_logout.php">Đăng xuất</a>
                    </div>
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

    <script src="./js/accountList_scripts.js"></script>
    <script>
        function reloadPage() {
            window.location.reload()
        }
    </script>
</body>

</html>