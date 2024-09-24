// Lọc theo giá

function filterList() {
    let list = document.getElementById("all");
    let opt = document.getElementById("selectPrice").value;
    let items = list.getElementsByClassName("col-md-3");
    let countItems = 0;
    if (opt == 1) {
        for (let i = 0; i < items.length; i++) {
            items[i].style.display = "block";
            countItems++;
        }
    } else if (opt == 2) {
        for (let i = 0; i < items.length; i++) {
            let price = items[i].querySelector(".fw-bold").textContent.slice(0, -1);
            if (parseInt(price, 10) * 1000 < 100000) {
                items[i].style.display = "block";
                countItems++;
            } else {
                items[i].style.display = "none";
            }
        }
    } else if (opt == 3) {
        for (let i = 0; i < items.length; i++) {
            let price = items[i].querySelector(".fw-bold").textContent.slice(0, -1);
            if (parseInt(price, 10) * 1000 >= 100000 && parseInt(price, 10) * 1000 <= 500000) {
                items[i].style.display = "block";
                countItems++;
            } else {
                items[i].style.display = "none";
            }
        }
    } else {
        for (let i = 0; i < items.length; i++) {
            let price = items[i].querySelector(".fw-bold").textContent.slice(0, -1);
            if (parseInt(price, 10) * 1000 > 500000) {
                items[i].style.display = "block";
                countItems++;
            } else {
                items[i].style.display = "none";
            }
        }
    }

    if (countItems <= 12) {
        removeListPage();
    } else {
        loadItem();
        displayListPage();
    }
}

//admin account
function initData() {
    const accountList = localStorage.getItem('accounts') || [];
    if (accountList.length === 0) {
        const userAccount = {
            name: "Hiếu ngu",
            username: "admin",
            email: "admin@gmail.com",
            password: "admin",
            active: true
        }
        const updateAccountList = [userAccount];
        const json = JSON.stringify(updateAccountList);
        localStorage.setItem('accounts', json);
    }
}

// //Đăng nhập / Đăng ký
// function signUp() {
//     event.preventDefault();
//     const name = document.getElementById("Name").value;
//     const email = document.getElementById("Email").value;
//     const username = document.getElementById("Username").value;
//     const password = document.getElementById("Password").value;
//     const password_2 = document.getElementById("Password_2").value;
//     if (password == password_2) {
//         const userAccount = {
//             name: name,
//             username: username,
//             email: email,
//             password: password,
//             active: true,
//         }

//         const accountList = localStorage.getItem('accounts') || [];
//         const parseAccountList = accountList.length > 0 ? JSON.parse(accountList) : accountList;
//         const updateAccountList = [...parseAccountList, userAccount];

//         const json = JSON.stringify(updateAccountList);
//         localStorage.setItem('accounts', json);
//         alert("Đăng ký thành công!");
//         window.location.href = "login.php";
//     }
//     else {
//         alert("Mật khẩu không khớp!");
//     }

// }

// function logIn() {
//     event.preventDefault();
//     const username = document.getElementById("Username").value;
//     const password = document.getElementById("Password").value;

//     const verifyUser = Accounts.verifyUser(username, password);

//     if (!verifyUser.verified) {
//         if (verifyUser.error_code === 'USER_NOT_FOUND') {
//             return alert("Đăng nhập thất bại!");
//         }
//         if (verifyUser.error_code === 'USER_LOCKED') {
//             return alert("Tài khoản đã bị khoá!");
//         }
//         return alert('NULL');
//     }
//     localStorage.setItem('loggedAccount', JSON.stringify(verifyUser.user));

//     if (verifyUser.user.username === 'admin') {
//         window.location.href = "./admin/accountList.php";
//     } else {
//         window.location.href = "index.php";
//     }
// }

// function showLatedLogin() {
//     const loggedAccount = localStorage.getItem('loggedAccount');
//     const parseAccount = JSON.parse(loggedAccount);

//     if (parseAccount.name) {
//         document.getElementById("showName").innerHTML = '';
//         document.getElementById("showName").href = 'index.php';

//         const elementReplace = '#showName'
//         const elementAppend = `
//             <div class="dropdown" id="showName">
//                 <div class="btn btn-outline-light" data-bs-toggle="dropdown">
//                     Xin chào, ${parseAccount.name}
//                 </div>
//                 <div class="dropdown-menu">
//                     <a class="dropdown-item" href="#" onClick="appendlogout()"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
//                 </div>
//             </div>
//         `

//         $(elementReplace).replaceWith(elementAppend);
//     }
// }


// // Logout
// function appendlogout() {
//     localStorage.removeItem('loggedAccount');

//     const elementReplace = '#showName'
//     const elementAppend = `
//         <a href="login.php" class="btn btn-outline-light" id="showName">
//             Đăng nhập / Đăng ký
//         </a>
//     `
//     $(elementReplace).replaceWith(elementAppend);
// }

// Search

function searchForProducts() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("searchBar");
    filter = input.value.toUpperCase();
    ul = document.getElementById("searchList");
    li = ul.getElementsByTagName("li");
    if (filter.length > 0) {
        ul.style.display = "block";
        for (i = 1; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
    else {
        ul.style.display = "none";
    }
}

// Read more

function readMore() {
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");

    if (moreText.style.display === "none") {
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
    } else {
        btnText.style.display = "none";
        moreText.style.display = "block";
    }
}


