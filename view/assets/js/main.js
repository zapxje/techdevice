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
const hotDealCountdown = document.querySelector(".hot-deal-countdown");
if (hotDealCountdown) {
  (function () {
    const second = 1000,
      minute = second * 60,
      hour = minute * 60,
      day = hour * 24;

    //I'm adding this section so I don't have to keep updating this pen every year :-)
    //remove this if you don't need it
    let today = new Date(),
      dd = String(today.getDate()).padStart(2, "0"),
      mm = String(today.getMonth() + 1).padStart(2, "0"),
      yyyy = today.getFullYear(),
      nextYear = yyyy + 1,
      dayMonth = "11/11/",
      saleday = dayMonth + yyyy;

    today = mm + "/" + dd + "/" + yyyy;
    if (today == saleday) {
      (document.getElementById("days").innerText = "00"),
        (document.getElementById("hours").innerText = "00"),
        (document.getElementById("minutes").innerText = "00"),
        (document.getElementById("seconds").innerText = "00");
      clearInterval(x);
    }
    console.log(saleday);
    console.log(today);
    //end

    const countDown = new Date(saleday).getTime(),
      x = setInterval(function () {
        const now = new Date().getTime(),
          distance = countDown - now;

        (document.getElementById("days").innerText = Math.floor(
          distance / day
        )),
          (document.getElementById("hours").innerText = Math.floor(
            (distance % day) / hour
          )),
          (document.getElementById("minutes").innerText = Math.floor(
            (distance % hour) / minute
          )),
          (document.getElementById("seconds").innerText = Math.floor(
            (distance % minute) / second
          ));

        //do something later when date is reached
        if (distance <= 0) {
          clearInterval(x);
        }
        //seconds
      }, 0);
  })();
}
