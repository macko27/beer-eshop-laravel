//import './bootstrap.js';


document.addEventListener("DOMContentLoaded", function () {

    //add to cart button
    let addToCartButton = $(".container-beer .addToCart");
    if (addToCartButton.length) {
        addToCartButton.on("click", function () {
            let beerID = $(".beerID").val();
            let quantity = $("#beerQuantity").val();
            ajax("POST", "/add-to-cart", { "beerID": beerID, "quantity": quantity });
        });
    }

    //quantity change inputs
    let quantityInputs = $(".beer-quantity-change");
    quantityInputs.on("change", function () {
        let beerID = $(this).data("beerId");
        let newQuantity = $(this).val();
        ajax("POST", "/update-cart", { "beerID": beerID, "newQuantity": newQuantity });
    });

    //delete buttons
    let deleteButtons = $(".cart-delete");
    deleteButtons.on("click", function (event) {
        event.preventDefault();
        let beerID = $(this).data("beerId");
        ajax("DELETE", "/cart-delete", { "beerID": beerID });
    });

    updateCartAmount();

    //navbar scroll listener
    $(window).on('scroll', function () {
        let navbar = $('.navbar');
        if ($(window).scrollTop() > 50) {
            navbar.addClass('transparent');
        } else {
            navbar.removeClass('transparent');
        }
    });

    setTimeout(function () {
        $('#customAlert').alert('close');
    }, 2000);

    document.getElementById("selectMenu").addEventListener('change', function () {
        this.form.submit();
    });
});

async function updateCartItems(cart) {
    let tableBody = document.querySelector(".cart-container table tbody");
    if (!tableBody) {
        return;
    }

    let cartArray = Object.values(cart);

    if (cartArray.length === 0) {
        tableBody = document.querySelector(".cart-container");
        tableBody.innerHTML = "";
        let p = document.createElement("p");
        let h1 = document.createElement("h1");
        p.innerHTML = "Tvoj košík je prázdny.";
        h1.innerHTML = "Tvoj nákupný košík";
        tableBody.appendChild(h1);
        tableBody.appendChild(p);
    } else {
        tableBody.innerHTML = "";
        let priceP = document.getElementById("cart-price");
        let price = 0;
        cartArray.forEach(function (cartItem) {
            price += cartItem.price * cartItem.quantity;
            let newRow = document.createElement("tr");
            newRow.innerHTML = '<td><img src="' + "storage/" + cartItem.picture + '" alt="beer"></td>' +
                '<td>' + cartItem.name + '</td>' +
                '<td><input class="text-center me-3 beer-quantity-change" data-beer-id="' + cartItem.beer_id + '" type="number" value="' + cartItem.quantity + '"></td>' +
                '<td>' + (cartItem.price * cartItem.quantity) + '€</td>' +
                '<td><button class="cart-delete" data-beer-id="' + cartItem.beer_id + '"><i class="bi bi-x-lg"></i></button></td>';
            newRow.id = "cartItem";
            tableBody.appendChild(newRow);

            let quantityInputs = $(".beer-quantity-change");
            quantityInputs.on("change", function () {
                let beerID = $(this).data("beerId");
                let newQuantity = $(this).val();
                ajax("POST", "/update-cart", { "beerID": beerID, "newQuantity": newQuantity });
            });

            let deleteButtons = $(".cart-delete");
            deleteButtons.on("click", function (event) {
                event.preventDefault();
                let beerID = $(this).data("beerId");
                ajax("DELETE", "/cart-delete", { "beerID": beerID });
            });
        });
        priceP.innerHTML = "Celková cena je: " + price + "€";
    }
}

async function ajax(method, url, data) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: method,
        url: url,
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            updateCartItems(response.cart);
            updateCartAmount();
            //alert(response.message);
        },
        error: function (error) {
            console.error("Error:", error);
        }
    });
}

async function updateCartAmount() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "GET",
        url: "/cart-amount",
        contentType: 'application/json',
        success: function (response) {
            let amount = response.amount;
            let cartAmount = document.querySelector(".cart-amount");
            cartAmount.innerHTML = amount;
        },
        error: function (error) {
            console.error("Error:", error);
        }
    });
}
