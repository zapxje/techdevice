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

})(jQuery);
// ==================== Js Main End ==================== //


// ==================== Function Countdown Start ==================== //
const targetDate = "2023-12-31T00:00:00";
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
    if(scanNofitication){
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
      scanDays.innerHTML = (days / 10) >= 1 ? days : `0${days}`;
      scanHours.innerHTML = (hours / 10) >= 1 ? hours : `0${hours}`;
      scanMinutes.innerHTML = (minutes / 10) >= 1 ? minutes : `0${minutes}`;
      scanSeconds.innerHTML = (seconds / 10) >= 1 ? seconds : `0${seconds}`;
    }
    }
    
  }, 1000);
}
countDown();
// ==================== Function Countdown End ==================== //

// ==================== Function View Cart Start ==================== //
(function () {
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
  const cartProducts = document.querySelectorAll(".listProduct");

  const priceTotal = document.getElementById("priceTotal");
  const subTotal = document.getElementById("subTotal");

  // const cart = JSON.parse(localStorage.getItem("cartProducts")) || [];

  // // ...
  // const checkoutBtn = document.querySelector("#checkoutBtn");

  // if (checkoutBtn) {
  //   checkoutBtn.addEventListener("click", handleCheckout);
  // }
  // function handleCheckout() {
  //   var totalPriceProduct = 0;
  //   var updatedCart = [];

  //   cartProducts.forEach((product) => {
  //     let price = parseInt(
  //       product
  //         .querySelector(".price")
  //         .textContent.replace("đ", "")
  //         .replace(",", "")
  //     );
  //     let quantity = parseInt(product.querySelector(".quantity-amount").value);
  //     let total = product.querySelector(".total");

  //     total.textContent = price * quantity + "đ";
  //     totalPriceProduct += parseInt(
  //       total.textContent.replace("đ", "").replace(",", "")
  //     );

  //     var nameProduct = product.querySelector(".name").innerHTML;
  //     var quantityProduct = quantity;
  //     var totalProduct = total.textContent;
  //     var checkoutProduct = {
  //       nameProduct: nameProduct,
  //       quantityProduct: quantityProduct,
  //       totalProduct: totalProduct,
  //     };

  //     updatedCart.push(checkoutProduct);
  //   });
  //   localStorage.setItem("cartProducts", JSON.stringify(updatedCart));
  //   // Lưu mảng cập nhật vào local storage sau khi đã duyệt qua tất cả sản phẩm
  //   window.location.href = "checkout.html";
  // }

  function handleCart() {
    var totalPriceProduct = 0;

    cartProducts.forEach((product) => {
      let price = parseInt(
        product
          .querySelector(".price")
          .textContent.replace("đ", "")
          .replace(",", "")
      );
      let quantity = parseInt(product.querySelector(".quantity-amount").value);
      let total = product.querySelector(".total");

      total.textContent = price * quantity + "đ";
      totalPriceProduct += parseInt(
        total.textContent.replace("đ", "").replace(",", "")
      );
    });
    if (!priceTotal || !subTotal) {
      return;
    }
    // Lưu mảng cập nhật vào local storage sau khi đã duyệt qua tất cả sản phẩm
    priceTotal.textContent = formatMoney(totalPriceProduct) + "đ";
    subTotal.textContent = formatMoney(totalPriceProduct) + "đ";
  }

  handleCart();

  function formatMoney(amount) {
    return amount.toLocaleString("vi-VN");
  }

})();

const messenger = document.querySelector('.messenger-logo');

if (messenger) {
  messenger.onclick = () => {
    const show = messenger.querySelector('.messenger-main');
    show.classList.toggle('show');
  }
}

if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
// ==================== Function View Cart End ==================== //

// ==================== Function filter start ==================== //

let arrFilter = productsArray;


const filter = document.querySelector('.filter');

filter.addEventListener('submit', function (e) {
  e.preventDefault();
  let valueFilter = e.target.elements;
    
    arrFilter= productsArray.filter(product => {
     
      if(valueFilter.name.value != ''){

        const filterValue = valueFilter.name.value.toUpperCase(); // Convert filter value to uppercase
        const productName = product.name.toUpperCase();
        if(productName.includes(filterValue)){
          return true;
        }
      }
      
      if(valueFilter.category.value != ''){
        
        if(product.id_category != valueFilter.category.value ){
          return false;
        }
      }
      
      
      return true;
    })
    displayProducts(arrFilter);
});
var productFilter = [];

const checkboxFilters = document.querySelectorAll('.input-checkbox input');
checkboxFilters.forEach((checkboxFilter) => {
  checkboxFilter.addEventListener('click', function () {
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
  const productsHTML = products.map(product => {
      return `<div class="col-md-4 col-xs-6">
                  <div class="product">
                      <div class="product-img">
                          <img src="${product.image}" alt="">
                      </div>
                      <div class="product-body">
                          <p class="product-category">categories</p>
                          <h3 class="product-name"><a href="#">PRODUCT NAME GOES HERE</a></h3>
                          <h4 class="product-price">$${product.price} <del class="product-old-price">$${product.price_sale}</del></h4>
                          <div class="product-rating">
                              <!-- Add code for product rating here -->
                          </div>
                          <div class="product-btns">
                              <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                              <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                              <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
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
  document.querySelector('#products').innerHTML = productsHTML.join('');
}