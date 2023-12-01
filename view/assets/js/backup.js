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