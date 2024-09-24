<?php
session_start();
include "header.php";
require 'connection.php';

$product_id = $_GET['id'];

// Kiểm tra xem có yêu cầu POST từ form thanh toán không
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart'])) {
    // Xử lý xác nhận đơn hàng
    // ...

    // Đánh dấu hoàn tất thanh toán
    $_SESSION['checkout_complete'] = true;

    // Chuyển hướng về trang chủ sau khi xử lý xong
    header("Location: index.php");
    exit();
}

// Kiểm tra nếu đã hoàn tất thanh toán, không làm gì cả
if (isset($_SESSION['checkout_complete']) && $_SESSION['checkout_complete']) {
    header("Location: index.php");
    exit();
}

// prepare the statement
$stmt = $conn->prepare("SELECT * FROM sanpham WHERE MA_SP = ?");
$stmt->bind_param("s", $product_id);

// execute the query
$stmt->execute();
$result = $stmt->get_result();
$user_address = '';
$user_name = '';
$user_phone = '';
if (isset($_SESSION['Username'])) {
    $username = $_SESSION['Username'];
    // prepare the statement
    $user_stmt = $conn->prepare("SELECT NAME, ADDRESS, PHONE_NUMBER FROM taikhoan WHERE USERNAME = ?");
    $user_stmt->bind_param("s", $username);

    // execute the query
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    if ($user_result->num_rows > 0) {
        $user_info = $user_result->fetch_assoc();
        $user_name = $user_info['NAME'];
        $user_address = $user_info['ADDRESS'];
        $user_phone = $user_info['PHONE_NUMBER'];
		$username = ($_SESSION['Username']);
    }
    $user_stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Giỏ hàng của bạn</title>
    <style>
        .popup {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }
    </style>
</head>
<body>
<br>



<!-- Thêm thư viện jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Các phần tử HTML khác trong trang -->

	
	<!-- Thanh toán thành công pop-up -->
<div id="paymentSuccess" class="modal modal-popup" style="display:none;">
  <div class="modal-content"> <span class="close-button" onclick="closePaymentSuccess()"></span>
    <h2>Thanh toán thành công</h2>
    <p>Vui lòng giữ máy để được gọi xác nhận đơn hàng.</p>
    <button class="muangay cainut" onclick="checkout()">Đóng</button>
  </div>
</div>
	
<div class="container margin-bottom-4" >
    <div class="row">
        <div class="shopping-cart margin-top-4 col-8" style="margin-bottom:250px" id="shopping-cart">
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>
                    <?php
                    $sql = "SELECT * FROM sanpham WHERE MA_SP = '$id'";
                    $result =                    mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tenSP = $row['TEN_SP'];
                            $giaSP = $row['GIA'];
                            $hinhAnh = $row['HINH_ANH'];
                        }
                    }

                    $tongCong = $giaSP * $quantity;
                    //in

                    echo '<div class="cart-item" style="width:100%; height:200px;padding:10px 10px;border:1px solid #212529;">';
                    echo "<img class='img-fluid w-100 rounded'style='height:60%;' src='$hinhAnh' />";
                    echo ' <div class="details">';
                    echo ' <div class="">';
                    echo "<i onclick=\"removeItem('$id')\" class=\"bi bi-x-lg float-end\"></i>";
                    echo "<h4 style='font-size: 19px;'>$tenSP</h4>";
                    echo ' </div>';
                    echo "<h4 class='cart-item-price' style = 'margin-right: 10px;'>$giaSP đ</h4>";
                    echo "<div  class='quantity'>Số lượng: $quantity</div>";
                    echo ' </div>';
                    echo ' </div>';
              endforeach;
          else: ?>
                <div class="text-center;" style="margin-left: 500px">
                    <h2 class="margin-top-10;" style="padding-left: 50px;">Giỏ hàng trống!</h2>
                    <p class="p-2">Thêm sản phẩm vào giỏ và quay lại trang này để thanh toán&#128526</p>
                    <img class="img-fluid" style="width: 600px;" src="img/emptyCart.png">
                </div>
            <?php endif; ?>
        </div>
        <div id="label" class="margin-top-4 col-4">
            <?php
            $tongTien = 0;
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $quantity) {
                    $sql = "SELECT GIA FROM sanpham WHERE MA_SP = '$id'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $giaSP = $row['GIA'];
                        }
                    }
                    $tongTien += $giaSP * $quantity;
                }
            }
            ?>

            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <h4 style="font-size: 20px;" class="text-center">Thanh toán</h4>
                <hr class="light-100 mt-1 w-100">
                <div class="d-flex justify-content-between">
                    <div class="mb-1" >Tổng giá trị sản phẩm:</div>
                    <?php echo $tongTien; ?>đ
                </div>
                <hr class="light-100 mt-1 w-100">
                <form class="needs-validation my-2">
                    <div class="form-group was-validated">
						
						<input style="display: none;" placeholder="Tên người nhận hàng" class="form-control mb-4" type="text" id="username" value="<?php echo $username; ?>" required>
						<input style="display: none;" placeholder="Tên người nhận hàng" class="form-control mb-4" type="text" id="thanhtien" value="<?php echo $tongTien; ?>" required>
                        <label class="form-label mb-3" for="NAME">Nhập tên người nhận hàng:</label>
                        <input placeholder="Tên người nhận hàng" class="form-control mb-4" type="text" id="NAME" value="<?php echo $user_name; ?>" required>
                        <label class="                        form-label mb-3" for="PHONE_NUMBER">Nhập số điện thoại người nhận hàng:</label>
                        <input placeholder="Số điện thoại nhận hàng" class="form-control mb-4" type="text" id="PHONE_NUMBER" value="<?php echo $user_phone; ?>" required>
                        <label class="form-label mb-3" for="ADDRESS">Nhập địa chỉ người nhận hàng:</label>
                        <input placeholder="Địa chỉ người nhận" class="form-control mb-4" type="text" id="ADDRESS" value="<?php echo $user_address; ?>" required>
                        <label class="form-label mb-3">Phương thức thanh toán:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="momo" value="momo" onclick="togglePaymentButton()">
                            <label class="form-check-label" for="momo">Momo (Chuyển khoản vào 0392585825 bằng giá trị sản phẩm với nội dung là số điện thoại đăng ký)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod" onclick="togglePaymentButton()">
                            <label class="form-check-label" for="cod">COD</label>
                            <br>Lưu ý: sau khi xác nhận thanh toán thành công, vui lòng kiểm tra để thoại thường xuyên được gọi xác nhận đơn hàng.
                        </div>
                    </div>
                </form>
                <div>
                    <button class="btn checkout w-100" onclick="openPopup()" style="background-color: #2579f2;" id="paymentButton" disabled>Xác nhận đơn hàng</button>
                    <button onclick="clearCart()" class="btn w-100 checkout" style="background-color: gray">Hủy toàn bộ giỏ</button>
                </div>
                <div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Popup -->

<script>
    function removeItem(id) {
        // Send an AJAX request to remove the item from the cart
        // Example using jQuery:
        $.ajax({
            type: "POST",
            url: "remove_item.php",
            data: {id: id},
            success: function (response) {
                // Refresh the cart page or update the cart information dynamically
                window.location.reload();
            }
        });
    }

    function clearCart() {
        // Send an AJAX request to clear the cart
        // Example using jQuery:
        $.ajax({
            type: "POST",
            url: "clear_cart.php",
            success: function (response) {
                // Refresh the cart page or update the cart information dynamically
                window.location.reload();
            }
        });
    }

    function togglePaymentButton() {
        var momoRadio = document.getElementById("momo");
        var codRadio = document.getElementById("cod");
        var paymentButton = document.getElementById("paymentButton");

        if (momoRadio.checked || codRadio.checked) {
            paymentButton.disabled = false;
        } else {
            paymentButton.disabled = true;
        }
    }
	
	
	function openPopup() {
  if (!<?php echo (isset($_SESSION['Username'])) ? 'true' : 'false'; ?>) {
    alert("Phải đăng nhập để mua hàng!");
    window.location.href = "./login.php";
  } 
    // hiển thị form
    document.getElementById('paymentSuccess').style.display = 'block';
  
}

    function checkout() {
		if (!<?php echo (isset($_SESSION['Username'])) ? 'true' : 'false'; ?>) {
    alert("Phải đăng nhập để mua hàng!");
    window.location.href = "./login.php";
  }
	else
		{
			
    // Disable the checkout button to prevent multiple clicks
    var checkoutButton = document.getElementById("paymentButton");
    checkoutButton.disabled = true;

    // Create an array to store the cart data
    var cart = [];

    // Loop through the cart items and add them to the array
    <?php
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $id => $quantity) {
            echo "cart.push({id: '$id', quantity: $quantity});";
        }
    }
    ?>
			
			var ten = $('#NAME').val();
			var diachi = $('#ADDRESS').val();
			var username = $('#username').val();
			var thanhtien = $('#thanhtien').val();
    // Send an AJAX request to the checkout.php file
    // Example using jQuery:
    $.ajax({
        type: "POST",
        url: "checkout.php",
        data: {cart: cart,
			  ten: ten,	
			  diachi: diachi,
			  username: username,
			  thanhtien: thanhtien,
			  },
        success: function (response) {
            // Display the popup
            var popup = document.getElementById("popup");
            popup.style.display = "block";

            // Clear the cart data in the current page


            // Update the cart count in the header (if needed)
            // Example: document.getElementById("cart-count").innerText = "0";

            // Reload the page to update the cart data
            location.reload();
        },
        success: function (response) {
                // Refresh the cart page or update the cart information dynamically
                window.location.reload();
            }
		
    });
} }

</script>
</body>
</html>
<?php
require 'footer.php';
?>

</body>
</html>
