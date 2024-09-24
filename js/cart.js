let label = document.getElementById("label");
let ShoppingCart = document.getElementById("shopping-cart");
let basket = JSON.parse(localStorage.getItem("data")) || [];

let calculation = () => {
  let cartIcon = document.getElementById("cartAmount");
  cartIcon.innerHTML = basket.map((x) => x.item).reduce((x, y) => x + y, 0);
};

calculation();

let generateCartItems = () => {
  if (basket.length !== 0) {
    return (ShoppingCart.innerHTML = basket
      .map((x) => {
        let { id, item } = x;
        let search = shopItemsData.find((y) => y.id === id) || [];
        return `
      <div class="cart-item" style="width:100%; height:139px;padding:10px 10px;border:1px solid #212529;">
        <img class="img-fluid w-100 rounded"" src=${search.img} c />
        <div class="details">
            <div class="">
              <i onclick="removeItem(${id})" class="bi bi-x-lg float-end"></i> 
              <h4 style="font-size: 19px;">${search.name} </h4>
            </div>
              <h4 class="cart-item-price"> ${search.price}.000đ</h4>
          <div class="buttons">
            <i onclick="decrement(${id})" class="bi bi-dash-lg"></i>
            <div id=${id} class="quantity">${item}</div>
            <i onclick="increment(${id})" class="bi bi-plus-lg"></i>
          </div>
        </div>
      </div>
      `;
      })
      .join(""));
  } else {
    ShoppingCart.classList.remove("margin-top-4");
    label.classList.remove("col-4");
    label.classList.add("text-center");
    ShoppingCart.innerHTML = ``;
    label.innerHTML = `
    <h2 class="margin-top-3">Giỏ hàng trống!</h2>
    <p class="p-2">Thêm sản phẩm vào giỏ và quay lại trang này để thanh toán&#128526</p>
    <img class="img-fluid" width="30%" src="../img/emptyCart.png">
    `;
  }
};

generateCartItems();

let increment = (id) => {
  let selectedItem = id;
  let search = basket.find((x) => x.id === selectedItem.id);

  if (search === undefined) {
    basket.push({
      id: selectedItem.id,
      item: 1,
    });
  } else {
    search.item += 1;
  }

  generateCartItems();
  update(selectedItem.id);
  localStorage.setItem("data", JSON.stringify(basket));
};
let decrement = (id) => {
  let selectedItem = id;
  let search = basket.find((x) => x.id === selectedItem.id);

  if (search === undefined) return;
  else if (search.item === 0) return;
  else {
    search.item -= 1;
  }
  update(selectedItem.id);
  basket = basket.filter((x) => x.item !== 0);
  generateCartItems();
  localStorage.setItem("data", JSON.stringify(basket));
};

let update = (id) => {
  let search = basket.find((x) => x.id === id);
  // console.log(search.item);
  document.getElementById(id).innerHTML = search.item;
  calculation();
  TotalAmount();
};

let removeItem = (id) => {
  let selectedItem = id;
  // console.log(selectedItem.id);
  basket = basket.filter((x) => x.id !== selectedItem.id);
  generateCartItems();
  TotalAmount();
  localStorage.setItem("data", JSON.stringify(basket));
};



let clearCart = () => {

  basket = [];
  generateCartItems();
  localStorage.setItem("data", JSON.stringify(basket));
};

function closePopup1() {
  let popup = document.getElementById("popup1");
  popup.classList.remove("open-popup");
  basket = [];
  generateCartItems();
  localStorage.setItem("data", JSON.stringify(basket));
}

let clearCartt = () => {
  // if (document.getElementById("showName").innerText === 'Đăng nhập / Đăng ký') {
  //   alert("Phải đăng nhập để mua hàng!");
  //   window.location.href = "../login.php";
  // }
  // else if(document.getElementById("subEmailCart").value.length <= 0) {
  //   alert("Phải nhập Email bổ sung!");
  // }
  // else {
  //   alert("Thanh toán thành công, vui lòng kiểm tra Email để nhận thông báo");
  //   basket = [];
  //   generateCartItems();
  //   localStorage.setItem("data", JSON.stringify(basket));
  // }

  let popup = document.getElementById("popup1");
  if (document.getElementById("showName").innerText === 'Đăng nhập / Đăng ký') {
    alert("Phải đăng nhập để mua hàng!");
    window.location.href = "../login.php";
  }
  else if (document.getElementById("subEmailCart").value.length <= 0) {
    alert("Phải nhập Email bổ sung!");
  }
  else {
    popup.classList.add("open-popup");
  }
};


let TotalAmount = () => {
  if (basket.length !== 0) {
    let amount = basket
      .map((x) => {
        let { item, id } = x;
        let search = shopItemsData.find((y) => y.id === id) || [];

        return item * search.price;
      })
      .reduce((x, y) => x + y, 0);
    if (amount > 999) {
      if (amount % 1000 == 0)
        amount = String(amount / 1000 + ".000");
      else if (amount % 100 == 0)
        amount = String(amount / 1000 + "00");
      else if (amount % 10 == 0)
        amount = String(amount / 1000 + "0");
      else
        amount = String(amount / 1000);
    }
    label.innerHTML = ` 
    <h4 style="font-size: 20px;" class="text-center">Thanh toán</h4>
    <hr class="light-100 mt-1 w-100">
    <div class="d-flex justify-content-between">
      <div class="mb-1">Tổng giá trị sản phẩm:</div>
      ${amount}.000đ
    </div>
    <hr class="light-100 mt-1 w-100">
    <form class="needs-validation my-2">
      <div class="form-group was-validated">
        <label class="form-label mb-3" for="Email">Nhập Email để nhận thông báo về tài khoản:</label>
        <input placeholder="Email" class="form-control mb-4" type="Email" id="subEmailCart" required>
      </div>
    </form>
    <div">
      <button class="btn checkout w-100" onclick="clearCartt()" style="background-color: #2579f2;">Thanh toán ngay</button>
    </div>
    <div>
      <button onclick="clearCart()" class="btn w-100 checkout" style="background-color: gray">Hủy toàn bộ giỏ</button>
    </div>
    `;
  } else return;
};




TotalAmount();