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

    // Thêm sự kiện input để lắng nghe thay đổi giá trị trong ô input
    $input.on("input", function () {
      var value = parseInt($(this).val());
      updatePriceSlider($this, value);
    });

  });

  var priceInputMax = document.getElementById("price-max"),
    priceInputMin = document.getElementById("price-min");

  if (priceInputMax) {
    priceInputMax.addEventListener("change", function () {
      updatePriceSlider($(this).parent(), this.value);
      console.log("Giá trị mới:", this.value);
    });
  }
  if (priceInputMin) {
    priceInputMin.addEventListener("change", function () {
      updatePriceSlider($(this).parent(), this.value);
      console.log("Giá trị mới:", this.value);
    });
  }

  function updatePriceSlider(elem, value) {
    if (elem.hasClass("price-min")) {
      console.log("min");
      // priceSlider.noUiSlider.set([value, null]);
    } else if (elem.hasClass("price-max")) {
      console.log("max");
      // priceSlider.noUiSlider.set([null, value]);
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
})(jQuery);
// ==================== Js Main End ==================== //

// ==================== Focus First Input ==================== //
// Tự động đặt trọng tâm vào input khi trang được tải
document.addEventListener("DOMContentLoaded", function () {
  // Lấy phần tử input có id là "firstInput"
  let firstInput = document.getElementById("firstInput");

  // Kiểm tra xem phần tử có tồn tại không
  if (firstInput) {
    // Nếu tồn tại, thực hiện đặt trọng tâm
    firstInput.focus();
  } else {
    // Xử lý trường hợp không tìm thấy phần tử
    console.error("Không tìm thấy phần tử với ID 'firstInput'");
  }
});
// ==================== Focus First Input ==================== //

// ==================== Add To Cart Success ==================== //

function showAlert(message, icon) {
  Swal.fire({
    title: message,
    icon: icon,
    showCancelButton: false,
    confirmButtonText: 'OK',
  });
}
// ==================== Add To Cart Success ==================== //

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
var storedCartState = JSON.parse(localStorage.getItem("cartState")) || [];
function reducer(state = storedCartState, action) {
  switch (action.type) {
    case "addToCart":
      return [...state, action.payload];
    case "deleToCart":
      return state.filter((item) => item.id !== action.payload);
    case "updateCart":
      return state.map((item) => {
        if (item.id == action.payload.id) {
          return action.payload;
        } else {
          return item;
        }
      });
    default:
      return state;
  }
}

const store = createStore(reducer);
const BtnAddtocart = document.querySelectorAll(".add-to-cart-btn");
BtnAddtocart.forEach((item) => {
  item.addEventListener("click", (e) => {
    showAlert("Thêm vào giỏ thành công!", "success");
    addToCart(e.target);
  });
});

function addToCart(x) {
  const y = x.parentElement.parentElement;
  let isImg = y.querySelector(".product-img");
  const element = y.querySelector(".product-price");
  const price = element.firstChild.nodeValue.trim();

  const id = y.dataset.id;
  const hadProduct = storedCartState.find((product) => product.id == id);

  if (hadProduct) {
    // Nếu đã tồn tại sp có cùng id
    const productExisted = storedCartState.find((item) => item.id == id);
    //Chố này nếu mà có truyền vào số lượng tức là trang Single thì vẫn += số lượng
    if (!isImg) {
      let qty = parseInt(y.querySelector('input[name="count"]').value);
      productExisted.count += qty;
    } else {
      productExisted.count++;
    }
    store.dispatch({
      type: "updateCart",
      payload: productExisted,
    });
  } else {
    if (isImg) {
      let img = y.children[0].children[0].children[0].src;
      let name = y.children[1].children[1].innerText;
      const product = {
        name: name,
        price: price,
        img: img,
        id: id,
        count: 1,
      };
      store.dispatch({
        type: "addToCart",
        payload: product,
      });
    } else {
      let fullname = document.querySelector(".product-name-single").innerText;
      let name = fullname.slice(0, 40) + "...";
      let img = document.querySelector(".product-preview img").src;
      let qty = parseInt(y.querySelector('input[name="count"]').value);
      console.log(qty);
      const product = {
        name: name,
        price: price,
        img: img,
        id: id,
        count: qty,
      };
      store.dispatch({
        type: "addToCart",
        payload: product,
      });
    }
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
                        <h3 class="product-name"><a href="index.php?act=singleProduct&id=${product.id}">${product.name}</a></h3>
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
  if (storedCartState.length == 0) {
    emptyCart();
  }
  let itemSummary = document.querySelector(".cart-summary small");
  let qty = document.querySelector(".qty");
  if (itemSummary) {
    itemSummary.innerText = storedCartState.length + ` (sản phẩm)`;
  }
  let subTotal = 0;
  let numberProduct = 0;
  let subTotalSummary = document.querySelector(".cart-summary h5");
  storedCartState.map((item) => {
    let qtyProductSummary = item.count;
    numberProduct += qtyProductSummary;
    let priceProductSummary = parseInt(item.price.replace(/\./g, ""));

    subTotal += qtyProductSummary * priceProductSummary;
  });
  qty.innerHTML = numberProduct;

  subTotalSummary.innerHTML = (subTotal) > 0 ? "TỔNG TIỀN: " + formatMoney(subTotal) + "đ" : "TỔNG TIỀN: ";
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

function emptyCart() {
  const ViewCartEmpty = document.querySelector(".before-footer-section")
  if (ViewCartEmpty) {
    ViewCartEmpty.innerHTML = `<div class="container">
                              <div class="row mb-5">
                                <div class="col-md-12 cart-empty">
                                  <img src="view/assets/img/empty_cart-removebg-preview.png" alt="">
                                  <h5>Giỏ hàng chưa có sản phẩm nào</h5>
                                  <a href="?act=products"><button class="primary-btn order-submit">Tiếp tục mua sắm</button></a>
                                </div>
                              </div>
                            </div>`;
  }
}
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
    let price = product.querySelector(".price").innerHTML;
    const id = product.querySelector(".delete").dataset.id;
    let quantity = parseInt(product.querySelector(".quantity-amount").value);
    let total = parseInt(product.querySelector(".total").textContent.replace("đ", "").replace(/\./g, ""));
    totalPriceProduct += total;

    var nameProduct = product.querySelector(".name").innerHTML;
    var checkoutProduct = {
      id: id,
      name: nameProduct,
      price: price,
      quantity: quantity,
    };



    updatedCart.push(checkoutProduct);
  });

  localStorage.setItem("cartProducts", JSON.stringify(updatedCart));
  // Lưu mảng cập nhật vào local storage sau khi đã duyệt qua tất cả sản phẩm
  window.location.href = "index.php?act=checkout";
}
const orderTotal = document.querySelector(".order-total");
const listOrder = document.querySelectorAll(".list-order");


let totalPriceProduct = 0;
listOrder.forEach((item) => {

  let priceOrder = parseInt(item.querySelector(".priceProduct").textContent.replace("đ", "").replace(/\./g, ""));
  let qtyOrder = parseInt(item.querySelector('.quantityProduct').textContent);
  totalPriceProduct += (priceOrder * qtyOrder);
});
if (orderTotal) {
  document.querySelector("input[name='total-order']").value = totalPriceProduct;
  orderTotal.textContent = totalPriceProduct > 0 ? formatMoney(totalPriceProduct) + "đ" : "";
}
//=========== END hàm CHECKOUT sản phẩm==========================

//===========hàm xử lí trang cart==========================
function handleCart() {
  var totalPriceProduct = 0;

  cartProducts.forEach((product) => {
    let price = product
      .querySelector(".price")
      .textContent.replace("đ", "")
      .replace(/\./g, "");
    let quantity = parseInt(product.querySelector(".quantity-amount").value);
    let total = product.querySelector(".total");

    total.textContent = formatMoney(price * quantity) + "đ";
    totalPriceProduct += price * quantity;
  });
  if (!priceTotal || !subTotal) {
    return;
  }
  // Lưu mảng cập nhật vào local storage sau khi đã duyệt qua tất cả sản phẩm

  priceTotal.textContent = totalPriceProduct > 0 ? formatMoney(totalPriceProduct) + "đ" : '';
  subTotal.textContent = totalPriceProduct > 0 ? formatMoney(totalPriceProduct) + "đ" : '';

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

