// //Pagination
// let thisPage = 1;
// let limit = 12;
// let list1 = document.querySelectorAll('.col-md-3');
// let list2 = document.querySelectorAll('.active .col-md-3');
// if (list1.length <= 15)
//     var list = list1;
// else
//     var list = list2;

// function loadItem() {
//     let count = 0;
//     let beginGet = limit * (thisPage - 1);
//     let endGet = limit * thisPage - 1;
//     list.forEach((item, key) => {
//         if (key >= beginGet && key <= endGet) {
//             item.style.display = 'block';
//             count++;
//         } else {
//             item.style.display = 'none';
//         }
//     })
//     listPage();
// }
// loadItem();

// function listPage() {
//     let count = Math.ceil(list.length / limit);
//     document.querySelector('.listPage').innerHTML = '';

//     if (thisPage != 1) {
//         let prev = document.createElement('li');
//         prev.innerText = '❮';
//         prev.setAttribute('onclick', "changePage(" + (thisPage - 1) + ")");
//         document.querySelector('.listPage').appendChild(prev);
//     }

//     for (i = 1; i <= count; i++) {
//         let newPage = document.createElement('li');
//         newPage.innerText = i;
//         if (i == thisPage) {
//             newPage.classList.add('active');
//         }
//         newPage.setAttribute('onclick', "changePage(" + i + ")");
//         document.querySelector('.listPage').appendChild(newPage);
//     }

//     if (thisPage != count) {
//         let next = document.createElement('li');
//         next.innerText = '❯';
//         next.setAttribute('onclick', "changePage(" + (thisPage + 1) + ")");
//         document.querySelector('.listPage').appendChild(next);
//     }
// }
// function changePage(i) {
//     thisPage = i;
//     loadItem();
// }
// function removeListPage() {
//     document.getElementById("page").style.display = "none";
// }
// function displayListPage() {
//     document.getElementById("page").style.display = "block";
// }



