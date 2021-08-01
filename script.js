$(document).ready(() => {
  $("#banner .owl-carousel").owlCarousel({
    dots: true,
    items: 1,
    loop: true,
  });

  $("#new-items .owl-carousel").owlCarousel({
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 4,
      },
    },
  });

  // book's pagination
  loadBookPage();
  function loadBookPage(page) {
    $.ajax({
      url: "template/book-ajax.php",
      type: "post",
      data: {
        book_page: page,
      },
      success: function (data) {
        $("#book-pagination").html(data);
      },
    });
  }

  $(document).on("click", ".book-pagination-link", function () {
    let id = $(this).attr("id").split("-")[2];
    loadBookPage(id);
  });
  // shoes's pagination
  loadShoePage();
  function loadShoePage(page) {
    $.ajax({
      url: "template/shoe-ajax.php",
      type: "post",
      data: {
        shoe_page: page,
      },
      success: function (data) {
        $("#shoe-pagination").html(data);
      },
    });
  }

  $(document).on("click", ".shoe-pagination-link", function () {
    let id = $(this).attr("id").split("-")[2];
    loadShoePage(id);
  });
});

// quantity buttons:
var qtyDown = document.querySelectorAll(".qty-down");
var qtyUp = document.querySelectorAll(".qty-up");

for (let i = 0; i < qtyDown.length; i++) {
  qtyDown[i].addEventListener("click", () => {
    var qtyField = document.querySelectorAll(".quantity-input")[i];
    var qty = Number(qtyField.value);
    $.ajax({
      url: "template/price-ajax.php",
      type: "post",
      data: {
        productid: qtyDown[i].getAttribute("data-id"),
        quantity: qty - 1,
      },
      success: function (res) {
        console.log("success");
        if (qty > 0) {
          qtyField.value = qty - 1;
          let data = JSON.parse(res); // decoded data returned from price-ajax.php
          let productPrice = data[0].product_price;
          let actualPrice = qtyField.value * productPrice; // new price of this product by multiplying the quantity
          // let temp = document.querySelectorAll('.cart-price')[i].innerHTML.split(' VND')[0];
          let priceField = document.querySelectorAll(".cart-price")[i];
          priceField.innerHTML =
            Intl.NumberFormat("en-US").format(parseInt(actualPrice)) + " VND";

          let subtotalField = document.querySelector("p.total-money span b");
          let subtotal = subtotalField.innerHTML
            .split(" VND")[0]
            .replaceAll(",", ""); // format currency to number by replacing commas
          subtotalField.innerHTML =
            (Number(subtotal) - Number(productPrice))
              .toString()
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " VND"; // show the new subtotal(with comma as seperator)
          let pre_money = document.querySelector("#premoney");
          pre_money.innerHTML = subtotalField.innerHTML;
        }
      },
    });
  });
}

for (let i = 0; i < qtyUp.length; i++) {
  qtyUp[i].addEventListener("click", () => {
    var qtyField = document.querySelectorAll(".quantity-input")[i];
    var qty = Number(qtyField.value);

    $.ajax({
      url: "template/price-ajax.php",
      type: "post",
      data: {
        productid: qtyUp[i].getAttribute("data-id"),
        quantity: qty + 1,
      },
      success: function (res) {
        if (qty < 10) {
          qtyField.value = qty + 1;
          let data = JSON.parse(res); // decoded data returned from price-ajax.php
          let productPrice = data[0].product_price;
          let actualPrice = qtyField.value * productPrice;
          // let temp = document.querySelectorAll('.cart-price')[i].innerHTML.split(' VND')[0];
          let priceField = document.querySelectorAll(".cart-price")[i];
          priceField.innerHTML =
            Intl.NumberFormat("en-US").format(parseInt(actualPrice)) + " VND";

          let subtotalField = document.querySelector("p.total-money span b");
          let subtotal = subtotalField.innerHTML
            .split(" VND")[0]
            .replaceAll(",", ""); // format currency to number by removing commas
          subtotalField.innerHTML =
            (Number(subtotal) + Number(productPrice))
              .toString()
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " VND";
          let pre_money = document.querySelector("#premoney");
          pre_money.innerHTML = subtotalField.innerHTML;
        }
      },
    });
  });
}

var passConfirmed = document.querySelector("#confirm-password");
passConfirmed.addEventListener("keyup", async (event) => {
  let pass = await document.querySelector("#password").value;
  let signupBtn = document.querySelector("#signupBtn");
  let errorField = document.querySelector("#signup-verification");
  if (event.target.value !== pass) {
    errorField.innerHTML = "Password doesnt match !";
    signupBtn.disabled = true;
  } else {
    errorField.innerHTML = "";
    signupBtn.disabled = false;
  }
});
