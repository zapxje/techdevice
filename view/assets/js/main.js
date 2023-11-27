import { createStore } from "https://cdn.skypack.dev/redux";
// ==================== Js Main Start ==================== //
(function ($) {
  "use strict";

  // Mobile Nav toggle
  $(".menu-toggle > a").on("click", function (e) {
    e.preventDefault();
    $("#responsive-nav").toggleClass("active");
  });

  // Fix cart dropdown from closing
  $(".cart-dropdown").on("click", function (e) {
    e.stopPropagation();
  });

  /////////////////////////////////////////

  // Products Slick
  $(".products-slick").each(function () {
    var $this = $(this),
      $nav = $this.attr("data-nav");

    $this.slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      infinite: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  });

  // Products Widget Slick
  $(".products-widget-slick").each(function () {
    var $this = $(this),
      $nav = $this.attr("data-nav");

    $this.slick({
      infinite: true,
      autoplay: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false,
    });
  });

  /////////////////////////////////////////

  // Product Main img Slick
  $("#product-main-img").slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: "#product-imgs",
  });

  // Product imgs Slick
  $("#product-imgs").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
    centerPadding: 0,
    vertical: true,
    asNavFor: "#product-main-img",
    responsive: [
      {
        breakpoint: 991,
        settings: {
          vertical: false,
          arrows: false,
          dots: true,
        },
      },
    ],
  });

  // Product img zoom
  var zoomMainProduct = document.getElementById("product-main-img");
  if (zoomMainProduct) {
    $("#product-main-img .product-preview").zoom();
  }

  /////////////////////////////////////////

  // Input number
  $(".input-number").each(function () {
    var $this = $(this),
      $input = $this.find('input[type="number"]'),
      up = $this.find(".qty-up"),
      down = $this.find(".qty-down");

    down.on("click", function () {
      var value = parseInt($input.val()) - 1;
      value = value < 1 ? 1 : value;
      $input.val(value);
      $input.change();
      updatePriceSlider($this, value);
    });

    up.on("click", function () {
      var value = parseInt($input.val()) + 1;
      $input.val(value);
      $input.change();
      updatePriceSlider($this, value);
    });
  });

  var priceInputMax = document.getElementById("price-max"),
    priceInputMin = document.getElementById("price-min");

  if (priceInputMax) {
    priceInputMax.addEventListener("change", function () {
      updatePriceSlider($(this).parent(), this.value);
    });
  }
  if (priceInputMin) {
    priceInputMin.addEventListener("change", function () {
      updatePriceSlider($(this).parent(), this.value);
    });
  }

  function updatePriceSlider(elem, value) {
    if (elem.hasClass("price-min")) {
      console.log("min");
      priceSlider.noUiSlider.set([value, null]);
    } else if (elem.hasClass("price-max")) {
      console.log("max");
      priceSlider.noUiSlider.set([null, value]);
    }
  }

  // Price Slider
  var priceSlider = document.getElementById("price-slider");
  if (priceSlider) {
    noUiSlider.create(priceSlider, {
      start: [1, 999],
      connect: true,
      step: 1,
      range: {
        min: 1,
        max: 999,
      },
    });

    priceSlider.noUiSlider.on("update", function (values, handle) {
      var value = values[handle];
      handle ? (priceInputMax.value = value) : (priceInputMin.value = value);
    });
  }
  const myAccount = document.querySelector(".my-account");
  const wrapperAccount = document.querySelector(".wrapper-account");
  const accountClose = document.querySelector(".my__account-close");
  if (myAccount) {
    myAccount.addEventListener("click", function () {
      wrapperAccount.classList.add("show");
    });
    accountClose.addEventListener("click", function () {
      wrapperAccount.classList.remove("show");
    });
  }
})(jQuery);
// ==================== Js Main End ==================== //

// ==================== Function Countdown Start ==================== //
const targetDate = "2023-12-30T00:00:00";
function countDown() {
  const targetTime = new Date(targetDate).getTime();
  const timeInterval = setInterval(() => {
    const scanNofitication = document.querySelector(".countdown-nofitication");
    const scanDays = document.querySelector(".countdown-days");
    const scanHours = document.querySelector(".countdown-hours");
    const scanMinutes = document.querySelector(".countdown-minutes");
    const scanSeconds = document.querySelector(".countdown-seconds");
    const currentTime = new Date().getTime();
    const timeRemaining = targetTime - currentTime;
    if (scanNofitication) {
      if (timeRemaining <= 0) {
        clearInterval(timeInterval);
        scanNofitication.innerHTML = "Đã hết thời gian giảm giá !";
      } else {
        const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        const hours = Math.floor(
          (timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        const minutes = Math.floor(
          (timeRemaining % (1000 * 60 * 60)) / (1000 * 60)
        );
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
        scanDays.innerHTML = days / 10 >= 1 ? days : `0${days}`;
        scanHours.innerHTML = hours / 10 >= 1 ? hours : `0${hours}`;
        scanMinutes.innerHTML = minutes / 10 >= 1 ? minutes : `0${minutes}`;
        scanSeconds.innerHTML = seconds / 10 >= 1 ? seconds : `0${seconds}`;
      }
    }
  }, 1000);
}
countDown();
// ==================== Function Countdown End ==================== //

// ==================== Function View Cart Start ==================== //

//thêm vào giỏ hàng
let storedCartState = JSON.parse(localStorage.getItem("cartState")) || [];
function reducer(state = storedCartState, action) {
  switch (action.type) {
    case "addToCart":
      return [...state, action.payload];
    case "deleToCart":
      return state.filter((item) => item.id !== action.payload);
    case "updateCart":
      return state.map(item => {
        if (item.id == action.payload.id) {
          return action.payload;
        } else {
          return item;
        }
      })
    default:
      return state;
  }
}

const store = createStore(reducer);
const BtnAddtocart = document.querySelectorAll(".add-to-cart-btn");
BtnAddtocart.forEach((item) => {
  item.addEventListener("click", (e) => {
    addToCart(e.target);
  });
});

function addToCart(x) {
  const y = x.parentElement.parentElement;
  const name = y.children[1].children[1].innerText;
  const element = y.querySelector(".product-price");
  const price = element.firstChild.nodeValue.trim();
  const img = y.children[0].children[0].children[0].src;
  const id = y.dataset.id
  const hadProduct = storedCartState.find(product => product.id == id)

  if (hadProduct) {

    // Nếu đã tồn tại sp có cùng id
    const productExisted = storedCartState.find(item => item.id == id);

    productExisted.count++;
    store.dispatch({
      type: "updateCart",
      payload: productExisted
    });
  } else {
    const product = {
      name: name,
      price: price,
      img: img,
      id: id,
      count: 1
    };


    store.dispatch({
      type: "addToCart",
      payload: product,
    });
  }
}
store.subscribe(() => {
  storedCartState = store.getState();
  localStorage.setItem("cartState", JSON.stringify(storedCartState));
  render();
});
function render() {
  // list cart
  const listCart = document.getElementById("cart-list");
  let productsHTML = "";

  storedCartState.forEach((product) => {
    productsHTML += ` <div class="product-widget">
                    <div class="product-img">
                        <img src="${product.img}" alt="">
                    </div>
                    <div class="product-body">
                        <h3 class="product-name"><a href="#">${product.name}</a></h3>
                        <h4 class="product-price"><span class="qty">${product.count}x</span>${product.price}</h4>
                    </div>
                    <button class="delete" data-id="${product.id}"><i class="fa fa-close"></i></button>
                </div>`;
  });
  listCart.innerHTML = productsHTML;

  //view cart
  const viewCart = document.querySelector(".view-cart");
  if (viewCart) {
    let productCart = "";
    storedCartState.forEach((product) => {

      productCart += `<tr class="listProduct">
                            <td class="product-thumbnail">
                              <img src="${product.img}" alt="Image" class="img-fluid">
                            </td>
                            <td class="product-name w-50">
                              <h4 class=" text-black name">${product.name}</</h4>
                            </td>
                            <td class="price ">${product.price}</td>
                            <td>
                              <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                  <button class="btn decrease" type="button">&minus;</button>
                                </div>
                                <input type="text" class=" text-center quantity-amount" value="${product.count}"  >
                                <div class="input-group-append">
                                  <button class="btn increase" type="button">&plus;</button>
                                </div>
                              </div>

                            </td>
                            <td class="total" class="h6"></td>
                            <td><button href="#" class="btn btn-black close delete" data-id="${product.id}"><i class="fa-solid fa-xmark"></i></button></td>
                          </tr>`;
    });
    viewCart.innerHTML = productCart;
  }

  let itemSumary = document.querySelector(".cart-summary small");
  let qty = document.querySelector(".qty");
  if (itemSumary) {
    itemSumary.innerText = storedCartState.length + ` (sản phẩm)`;
    qty.innerHTML = storedCartState.length;
  }
  let subTotal = 0;
  let subTotalSummary = document.querySelector(".cart-summary h5");
  storedCartState.map(item => {
    return subTotal += parseInt(item.price.replace(".", "").replace(".", ""));
  })
  subTotalSummary.innerHTML = "TỔNG TIỀN: " + formatMoney(subTotal) + 'đ';
  const deleToCart = document.querySelectorAll(".delete");
  deleToCart.forEach((item) => {
    item.addEventListener("click", function () {
      const productId = item.getAttribute("data-id");
      store.dispatch({
        type: "deleToCart",
        payload: productId,
      });
      cartProducts = document.querySelectorAll(".listProduct");
      // Call handleCart to update the displayed cart information
      handleCart();
    });

  });
}
render();

// ====================END Function View Cart Start ==================== //

// =========== hàm tăng số lượng sản phẩm==========================
var sitePlusMinus = function () {
  var value,
    quantity = document.getElementsByClassName("quantity-container");

  function createBindings(quantityContainer) {
    var quantityAmount =
      quantityContainer.getElementsByClassName("quantity-amount")[0];
    var increase = quantityContainer.getElementsByClassName("increase")[0];
    var decrease = quantityContainer.getElementsByClassName("decrease")[0];
    increase.addEventListener("click", function (e) {
      increaseValue(e, quantityAmount);
    });
    decrease.addEventListener("click", function (e) {
      decreaseValue(e, quantityAmount);
    });
  }

  function init() {
    for (var i = 0; i < quantity.length; i++) {
      createBindings(quantity[i]);
    }
  }

  function increaseValue(event, quantityAmount) {
    value = parseInt(quantityAmount.value, 10);

    value = isNaN(value) ? 0 : value;
    value++;
    quantityAmount.value = value;
    handleCart();
  }

  function decreaseValue(event, quantityAmount) {
    value = parseInt(quantityAmount.value, 10);

    value = isNaN(value) ? 0 : value;
    if (value > 0) value--;

    quantityAmount.value = value;
    handleCart();
  }

  init();
};
sitePlusMinus();
//=========== END hàm tăng số lượng sản phẩm==========================



var cartProducts = document.querySelectorAll(".listProduct");
const priceTotal = document.getElementById("priceTotal");
//=========== hàm CHECKOUT sản phẩm==========================
// ...
const checkoutBtn = document.querySelector("#checkoutBtn");

if (checkoutBtn) {
  checkoutBtn.addEventListener("click", handleCheckout);
}
function handleCheckout() {
  var totalPriceProduct = 0;
  var updatedCart = [];

  cartProducts.forEach((product) => {
    let price = parseInt(
      product
        .querySelector(".price")
        .textContent.replace("đ", "").replace(".", "").replace(".", "")
    );
    let quantity = parseInt(product.querySelector(".quantity-amount").value);
    let total = product.querySelector(".total");

    total.textContent = price * quantity + "đ";
    totalPriceProduct += parseInt(
      total.textContent.replace("đ", "").replace(",", "")
    );

    var nameProduct = product.querySelector(".name").innerHTML;
    var quantityProduct = quantity;
    var totalProduct = total.textContent;
    var checkoutProduct = {
      name: nameProduct,
      quantity: quantityProduct,
      total: totalProduct,
    };

    updatedCart.push(checkoutProduct);
  });
  localStorage.setItem("cartProducts", JSON.stringify(updatedCart));
  // Lưu mảng cập nhật vào local storage sau khi đã duyệt qua tất cả sản phẩm
  window.location.href = "index.php?act=checkout";
}
const orderTotal = document.querySelector(".order-total");
const totalPrice = document.querySelectorAll(".priceProduct");
let total = 0;
totalPrice.forEach((price) => {
  total += parseFloat(price.textContent.replace("đ", "").replace(".", ""));
});
if (orderTotal) {
  orderTotal.textContent = formatMoney(total) + "đ";
}
//=========== END hàm CHECKOUT sản phẩm==========================

//===========hàm xử lí trang cart==========================
function handleCart() {
  var totalPriceProduct = 0;

  cartProducts.forEach((product) => {
    let price =
      product
        .querySelector(".price")
        .textContent.replace("đ", "").replace(".", "").replace(".", "")
      ;

    let quantity = parseInt(product.querySelector(".quantity-amount").value);
    let total = product.querySelector(".total");

    total.textContent = formatMoney(price * quantity) + "đ";
    console.log(total.textContent);
    totalPriceProduct += price * quantity;
  });
  if (!priceTotal || !subTotal) {
    return;
  }
  // Lưu mảng cập nhật vào local storage sau khi đã duyệt qua tất cả sản phẩm
  priceTotal.textContent = formatMoney(totalPriceProduct) + "đ";
  subTotal.textContent = formatMoney(totalPriceProduct) + "đ";

}
handleCart();
//===========END hàm xử lí trang cart==========================


// HÀM ĐỊNH NGHĨA TIỀN TỆ
function formatMoney(amount) {
  return amount.toLocaleString("vi-VN");
}

const messenger = document.querySelector(".messenger-logo");

if (messenger) {
  const closeMessenger = document.getElementById("close-messenger");
  const btnMessenger = document.querySelector(".btn-messenger");
  const messengerBody = document.querySelector(".messenger-body");
  const chatBox = document.querySelector(".chat-box");
  closeMessenger.onclick = () => {
    const show = document.querySelector(".messenger-main");
    show.classList.toggle("show");
    messengerBody.classList.add("show");
    chatBox.classList.remove("show");
  };
  messenger.onclick = () => {
    const show = document.querySelector(".messenger-main");
    show.classList.toggle("show");
    messengerBody.classList.add("show");
    chatBox.classList.remove("show");
  };
  if (btnMessenger) {
    btnMessenger.onclick = () => {
      messengerBody.classList.remove("show");
      chatBox.classList.add("show");
    };
  }
}

if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
// ==================== Function View Cart End ==================== //

// ==================== Function filter start ==================== //

let arrFilter = productsArray;

const filter = document.querySelector(".filter");

filter.addEventListener("submit", function (e) {
  e.preventDefault();
  let valueFilter = e.target.elements;

  arrFilter = productsArray.filter((product) => {
    if (valueFilter.name.value != "") {
      const filterValue = valueFilter.name.value.toUpperCase(); // Convert filter value to uppercase
      const productName = product.name.toUpperCase();
      if (productName.includes(filterValue)) {
        return true;
      }
    }

    if (valueFilter.category.value != "") {
      if (product.id_category != valueFilter.category.value) {
        return false;
      }
    }

    return true;
  });
  displayProducts(arrFilter);
});
var productFilter = [];

const checkboxFilters = document.querySelectorAll(".input-checkbox input");
checkboxFilters.forEach((checkboxFilter) => {
  checkboxFilter.addEventListener("click", function () {
    // Get all checked checkboxes
    const checkedCheckboxes = Array.from(checkboxFilters).filter(
      (checkbox) => checkbox.checked
    );

    if (checkedCheckboxes.length > 0) {
      // If at least one checkbox is checked
      productFilter = productsArray.filter((product) => {
        // Check if the product's category matches any checked checkbox value
        return checkedCheckboxes.some(
          (checkbox) => product.id_category == checkbox.value
        );
      });

      displayProducts(productFilter);
    } else {
      // If no checkbox is checked, display all products
      displayProducts(productsArray);
    }
  });
});

function displayProducts(products) {
  let productsHTML = "";
  products.forEach((product) => {
    productsHTML += `<div class="col-md-4 col-xs-6">
              <div class="product">
                <div class="product-img">
                  <img src="view/assets/img/product/${product.image}" alt="">
                </div>
                <div class="product-body">
                  <p class="product-category">Category</p>
                  <h3 class="product-name"><a href="#">${product.name}</a></h3>
                  <h4 class="product-price">
                    ${product.price_sale
        ? formatMoney(product.price_sale) + "đ"
        : formatMoney(product.price) + "đ"
      }
                    <del class="product-old-price">${product.price ? formatMoney(product.price) + "đ" : ""
      }</del>
                  </h4>
                  <div class="product-rating">
                  </div>
                  <div class="product-btns">
                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick
                        view</span></button>
                  </div>
                </div>
                <div class="add-to-cart">
                  <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                </div>
              </div>
            </div>`;
  });

  // ==================== Function filter end ==================== //

  // Join the array of HTML strings and insert into the DOM
  document.querySelector("#products").innerHTML = productsHTML;
}


// Lắng nghe sự kiện change cho mỗi checkbox
// checkboxFilters.forEach(checkbox => {
//     checkbox.addEventListener('change', function() {
//         // Tạo một mảng để lưu trữ giá trị của các checkbox được chọn
//         const selectedCategories = [];

//         // Lặp qua tất cả các checkbox và thêm giá trị vào mảng nếu được chọn
//         checkboxFilters.forEach(cb => {
//             if (cb.checked) {
//                 selectedCategories.push(cb.value);
//             }
//         });

//         // Tạo một URL mới với tham số query là các giá trị của checkbox được chọn
//         const url = '/duanmau1/?act=store/' + selectedCategories.join(',');

//         // Chuyển hướng đến URL mới
//         window.location.href = url;
//     });
// });