
<?php
session_start();
include "header.php";
require "connection.php";

$product_id = $_GET[ 'id' ];

// prepare the statement
$stmt = $conn->prepare( "SELECT * FROM sanpham WHERE MA_SP = ?" );
$stmt->bind_param( "s", $product_id );

// execute the query
$stmt->execute();
$result = $stmt->get_result();
if ( isset( $_SESSION[ 'Username' ] ) ) {
  // Nếu đã đăng nhập, hiển thị tên người dùng
  echo '<div class="dropdown" id="showName">';
  echo '<div class="btn btn-outline-light" data-bs-toggle="dropdown">';
  echo 'Xin chào, ' . $_SESSION[ 'Username' ];
  echo '</div>';
  echo '<div class="dropdown-menu">';
  echo '<a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>';
  echo '</div>';
  echo '<div class="btn btn-outline-light" data-bs-toggle="dropdown">';
  echo 'Xin chào, ' . $_SESSION[ 'Username' ];
  echo '</div>';
  echo '<div class="dropdown-menu">';
  echo '<a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>';
  echo '</div>';
  echo '</div>';
} else {
  // Nếu chưa đăng nhập, hiển thị nút đăng nhập
  echo '<a class="btn btn-outline-light" href="login.php">Đăng nhập</a>';
}
// lấy thông tin người dùng từ database nếu đã đăng nhập
$user_address = '';
$user_phone = '';
if ( isset( $_SESSION[ 'Username' ] ) ) {
  $username = $_SESSION[ 'Username' ];
  // prepare the statement
  $user_stmt = $conn->prepare( "SELECT NAME, ADDRESS, PHONE_NUMBER FROM taikhoan WHERE USERNAME = ?" );
  $user_stmt->bind_param( "s", $username );

  // execute the query
  $user_stmt->execute();
  $user_result = $user_stmt->get_result();
  if ( $user_result->num_rows > 0 ) {
    $user_info = $user_result->fetch_assoc();
    $user_name = $user_info[ 'NAME' ];
    $user_address = $user_info[ 'ADDRESS' ];
    $user_phone = $user_info[ 'PHONE_NUMBER' ];
  }
  $user_stmt->close();
	
}
?>  
<link rel="stylesheet" href="detail.css">
<!-- Purchase form -->
<div id="purchaseForm" class="modal modal-popup" style="display:none;">
  <div class="modal-content"> <span class="close-button" onclick="closeForm()">&times;</span>
    <h3>Thông tin thanh toán</h3>
    <div id="customerInfo" style="text-align: left;">
		
      <label type="Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="display: inline-block; width: 150px;">Tên khách hàng:</label>
      <input type="text" id="nickname" value="<?php echo $username; ?>" type="name" class="form-control"  aria-describedby="emailHelp" placeholder="Nhập tên khách hàng." style="display: none">
		
		<input type="text" id="customerName" value="<?php echo $user_name; ?>" type="name" class="form-control"  aria-describedby="emailHelp" placeholder="Nhập tên khách hàng.">
		
      <br/>
      <label type="email" class="form-control" id="exampleInputEmail1" aria-describedby="phoneNumber" style="display: inline-block; width: 150px;">Số điện thoại:</label>
      <input type="text" id="phone" value="<?php echo $user_phone; ?>" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Nhập số điện thoại. ">
      <br/>
      <label type="email" class="form-control" id="exampleInputEmail1" aria-describedby="Address" style="display: inline-block; width: 150px;">Địa chỉ:</label>
 <input type="text" id="address" value="<?php echo $user_address; ?>" type="name" class="form-control"  aria-describedby="emailHelp" placeholder="Nhập địa chỉ.">
    </div>
    <br>
    <!-- Thanh toán trực tuyến và COD -->
    <div style="text-align: left;">
      <label style="display: inline-block; width: 200px;">Phương thức thanh toán:</label>
      <input class="form-check-input" type="radio" id="onlinePayment" name="payment" value="online" style="display: inline-block; margin-right: 20px;">
      <label for="onlinePayment" style="display: inline-block; ">Momo</label>
      <input class="form-check-input" type="radio" id="COD" name="payment" value="COD" style="display: inline-block; margin-right: 20px;">
      <label for="COD" style="display: inline-block; margin-right: 40px;">COD</label>
    </div>
   
      <!-- Nội dung thông tin thanh toán trực tuyến --> 
		
		<label type="email" class="form-control" id="onlinePaymentInfo" aria-describedby="emailHelp" style="display: inline-block; width: 450px; display: none;">Lưu ý:</label>
		
		
    
   
      <!-- Nội dung thông tin COD --> 
		<label id="CODInfo" type="email" class="form-control" id="onlinePaymentInfo" aria-describedby="emailHelp" style="display: inline-block; width: 450px;display: none;"></label>
		

    <div style="text-align: center; margin-top: 20px;">
      <button class="muangay cainut" id="paymentButton" onclick="processPayment()" style="display: none; margin-left: auto;
    margin-right: auto;">Thanh toán</button>
    </div>
  </div>
</div>
<!-- Thanh toán thành công pop-up -->
<div id="paymentSuccess" class="modal modal-popup" style="display:none;">
  <div class="modal-content"> <span class="close-button" onclick="closePaymentSuccess()">×</span>
    <h2>Thanh toán thành công</h2>
    <p>Vui lòng giữ máy để được gọi xác nhận đơn hàng.</p>
    <button class="muangay cainut" onclick="ThanhToanXong()">Hoàn thành đơn</button>
  </div>
</div>

<!-- Confirm payment pop-up -->
<div id="confirmPayment" class="modal modal-popup" style="display:none;">
  <div class="modal-content"> <span class="close-button" onclick="closeConfirm()">×</span>
    <h2>Xác nhận thanh toán</h2>
    <p>Tên khách hàng: <span id="confirmCustomerName"></span></p>
    <p>Số điện thoại: <span id="confirmPhone"></span></p>
    <p>Địa chỉ: <span id="confirmAddress"></span></p>
    <p>Số tiền thanh toán: <span id="confirmAmount"></span></p>
    <button class="muangay cainut"  id="buy-button" data-product-id="<?php echo $product_id ?>" onclick="confirmPayment()">Xác nhận</button>
  </div>
</div>

<!-- Detail -->
<div class="container mt-2" id="shop" style="padding-top: 60px; display:block;">
  <div id="ChiTiet" class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-1">
    <?php
    if ( $result->num_rows > 0 ) {
      $product = $result->fetch_assoc();
      ?>
    <div class="col-md-3"> <img class="img-fluid rounded w-100" src="<?php echo $product["HINH_ANH"]; ?>"> </div>
    <div class="col-md-6">
      <h4> <?php echo $product["TEN_SP"]; ?> </h4>
      <div class="my-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-command"
            viewBox="0 0 16 16">
          <path
              d="M3.5 2A1.5 1.5 0 0 1 5 3.5V5H3.5a1.5 1.5 0 1 1 0-3zM6 5V3.5A2.5 2.5 0 1 0 3.5 6H5v4H3.5A2.5 2.5 0 1 0 6 12.5V11h4v1.5a2.5 2.5 0 1 0 2.5-2.5H11V6h1.5A2.5 2.5 0 1 0 10 3.5V5H6zm4 1v4H6V6h4zm1-1V3.5A1.5 1.5 0 1 1 12.5 5H11zm0 6h1.5a1.5 1.5 0 1 1-1.5 1.5V11zm-6 0v1.5A1.5 1.5 0 1 1 3.5 11H5z" />
        </svg>
        Tình trạng: <span style="color:#29b474">Còn hàng</span> </div>
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag"
            viewBox="0 0 16 16">
          <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z" />
          <path
              d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z" />
        </svg>
        <?php
        if ( $product[ "MA_LOAI" ] == "FF" )
          echo "Mũ FULL FACE";
        else if ( $product[ "MA_LOAI" ] == "12F" )
          echo "Mũ Nửa Đầu";
        else
          echo "Mũ 3/4 Đầu";
        ?>
      </div>
      <h4 class="mt-2">
        <?php
        $formatted_price = number_format( $product[ "GIA" ] );
        echo $formatted_price . "đ";
		 $THANHTIEN =  $product[ "GIA" ];
		
        ?>
        &nbsp; </h4>
      <p> <b>Chi tiết: </b> <?php echo $product["CHI_TIET"] ?> </p>
      <div class="border-bottom"></div>
      <?php
      } else {
        echo "Product not found";
      }
      $stmt->close();
      $conn->close();
      ?>
      <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 mt-2">
        <div class="col-md-6">
          <button class="muangay cainut" onclick="openPopup()">
          <iconify-icon icon="bi:credit-card-2-front-fill"></iconify-icon>
          Mua ngay </button>
          <div class="popup" id="popup"> <img src="../img/BlueTick.png">
            <p class="p-2">Mua hàng thành công</p>
            <button class="btn btn-primary" type="button" onclick="closePopup()">
            <p class="text-light mt-2 fs-5 ">Vui lòng thanh toán 200,000 tiền vào momo 0392585825</p>
            </button>
          </div>
          <script>

 function openPopup() {
  if (!<?php echo (isset($_SESSION['Username'])) ? 'true' : 'false'; ?>) {
    alert("Phải đăng nhập để mua hàng!");
    window.location.href = "./login.php";
  } else {
    // hiển thị form
    document.getElementById('purchaseForm').style.display = 'block';
  }
}


  function closeForm() {
  // ẩn form
  document.getElementById('purchaseForm').style.display = 'none';
}

</script> 
        </div>
        <div class="col-md-6">
          <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $maSP; ?>">
            <input style="margin-top:-1px; padding-bottom: 11px;" class="muangay cainut"  type="submit" name="addToCart" value="Thêm vào giỏ hàng">
          </form>
          <div id="Canva1nam" style="overflow: hidden;visibility:hidden;">0</div>
        </div>
      </div>
    </div>
    <div class="col-md-3"> <i class="fa-solid fa-money-check-dollar fa-xl"></i> <b style="margin-left:10px;">THANH TOÁN TIỆN LỢI</b><br>
      <br>
      <i class="fa-solid fa-phone fa-xl"></i> <b style="margin-left:10px;">HỖ TRỢ MUA HÀNG</b><br>
      <p style="margin-left:40px;font-size:15px;">(<b>Hotline:</b> 0886.770.888)</p>
      <i class="fa-regular fa-clock fa-xl"></i> <b style="margin-left:10px;">THỜI GIAN HOẠT ĐỘNG</b><br>
      <p style="margin-left:40px;font-size:15px;">(Từ 8:00 - 17:00 Từ T2 - T6) <br>
        (Từ 8:00 - 12:00 Từ T7 - CN)</p>
    </div>
  </div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom mt-4"></div>
  <div class="d-flex justify-content-between mt-3">
    <h5>Các sản phẩm khác mà bạn có thể thích</h5>
    <a class="" href="index.php">Tiếp tục mua hàng <i class="fa-solid fa-right-from-bracket"></i></a> </div>
  <div class="row row-cols-3 row-cols-lg-3 g-2 g-lg-3 mt-1"> <a class="col-md-3" href="detail.php?id=FF5"> <img src="img/FF5.jpg" class="img-fluid rounded w-100"> </a> <a class="col-md-3" href="detail.php?id=FF4"> <img src="img/FF4.jpg" class="img-fluid rounded w-100"> </a> <a class="col-md-3" href="detail.php?id=12F3"> <img src="img/12F3.jpg" class="img-fluid rounded w-100"> </a> <a class="col-md-3" href="detail.php?id=34F3"> <img src="img/34F3.jpg" class="img-fluid rounded w-100"> </a> </div>
</div>
<script>
  window.onload = function() {
    // Lắng nghe sự kiện thay đổi của radio button
    document.getElementById('onlinePayment').addEventListener('change', function() {
      if (this.checked) {
        var price = "<?php echo $formatted_price; ?>";
        document.getElementById('onlinePaymentInfo').style.display = 'block';
        document.getElementById('onlinePaymentInfo').innerHTML = 'Vui lòng thanh toán ' + price + ' tiền vào momo 0392585825.';
        document.getElementById('CODInfo').style.display = 'none';
        document.getElementById('CODInfo').innerHTML = '';
        document.getElementById('paymentButton').style.display = 'block';
      }
    });

    document.getElementById('COD').addEventListener('change', function() {
      if (this.checked) {
        var price = "<?php echo $formatted_price; ?>";
        document.getElementById('CODInfo').style.display = 'block';
        document.getElementById('CODInfo').innerHTML = 'Vui lòng thanh toán ' + price + ' tiền cho shipper khi giao hàng tới.';
        document.getElementById('onlinePaymentInfo').style.display = 'none';
        document.getElementById('onlinePaymentInfo').innerHTML = '';
        document.getElementById('paymentButton').style.display = 'block';
      }
    });
  }
// Function to close the payment success pop-up
function closePaymentSuccess() {
  document.getElementById('paymentSuccess').style.display = 'none';
}

// Function to confirm the payment
function confirmPayment() {
  // Get product id from somewhere (a form, for example)
  
  // TODO: Process the payment here

  // Close the confirm payment pop-up
  document.getElementById('confirmPayment').style.display = 'none';
  // Show the payment success pop-up
  document.getElementById('paymentSuccess').style.display = 'block';
}

  // Function to close the purchase form pop-up
  function closeForm() {
    document.getElementById('purchaseForm').style.display = 'none';
  }

  // Function to close the confirm payment pop-up
  function closeConfirm() {
    document.getElementById('confirmPayment').style.display = 'none';
  }

  // Function to process the payment
  function processPayment() {
    var customerName = document.getElementById('customerName').value;
    var phone = document.getElementById('phone').value;
     var diachi = document.getElementById('address').value;

	  
    var paymentMethod = document.querySelector('input[name="payment"]:checked').value;
    var total = "<?php echo $formatted_price; ?>";
    var confirmationMessage = 'Xác nhận thanh toán:\nTên khách hàng: ' + customerName + '\nSố điện thoại: ' + phone + '\nĐịa chỉ: ' + address + '\nPhương thức thanh toán: ' + paymentMethod + '\nTổng số tiền thanh toán: ' + total;
  
      // Show the confirm payment pop-up
      document.getElementById('confirmCustomerName').innerHTML = customerName;
      document.getElementById('confirmPhone').innerHTML = phone;
      document.getElementById('confirmAddress').innerHTML = diachi;
      document.getElementById('confirmAmount').innerHTML = total;
      document.getElementById('confirmPayment').style.display = 'block';
    
  }
  function ThanhToanXong() {
	  location.reload();

  }
  // Function to confirm the payment
  function confirmPayment() {
    // Get product id from somewhere (a form, for example)
  
            // TODO: Process the payment here

            // Close the confirm payment pop-up
            document.getElementById('confirmPayment').style.display = 'none';
            // Close the purchase form pop-up
            document.getElementById('purchaseForm').style.display = 'none';
	  
	  		document.getElementById('paymentSuccess').style.display = 'block';
            // Reset the form values
           
            document.querySelector('input[name="payment"]:checked').checked = false;
	  
        }
 
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    $('#buy-button').click(function() {
		var product_id = $(this).data('product-id');
		var username = $(this).data('username');
		var thanhtien = <?php echo $product[ "GIA" ] ?>;
		var ten = $('#customerName').val();
		var diachi = $('#address').val();
		var sodienthoai = $('#phone').val();
		var nickname = $('#nickname').val();
		
		
     $.ajax({
        url: 'buy_product.php',
        type: 'POST',
        data: {
            id: product_id,
			ten: ten,
			diachi: diachi,
			username: username,
			sodienthoai: sodienthoai,
			nickname: nickname,
			thanhtien: thanhtien,
			
        },
        success: function(response) {
            // Xử lý thành công
            console.log('Yêu cầu thành công');
            console.log(response);
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi
            console.log('Đã xảy ra lỗi');
            console.log(error);
        }
    });
});

  



</script> 
<!-- Footer -->

<?php
require 'footer.php';
?>

