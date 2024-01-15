//import './bootstrap.js';


document.addEventListener("DOMContentLoaded", function () {

    updateCartAmount();

    // Navbar scroll listener
    window.addEventListener('scroll', function () {
        let navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('transparent');
        } else {
            navbar.classList.remove('transparent');
        }
    });

    // Add to cart button
    let addToCartButton = document.querySelector(".container-beer .addToCart");
    if (addToCartButton) {
        addToCartButton.addEventListener("click", function () {
            let beerID = document.querySelector(".beerID").value;
            let quantity = document.getElementById("beerQuantity").value;
            ajax("POST", "/add-to-cart", { "beerID": beerID, "quantity": quantity });
        });
    }

    // Quantity change inputs
    let quantityInputs = document.querySelectorAll(".beer-quantity-change");
    quantityInputs.forEach(function (input) {
        input.addEventListener("change", function () {
            let beerID = input.dataset.beerId;
            let newQuantity = input.value;
            ajax("POST", "/update-cart", { "beerID": beerID, "newQuantity": newQuantity });
        });
    });

    // Delete buttons
    let deleteButtons = document.querySelectorAll(".cart-delete");
    deleteButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            let beerID = button.dataset.beerId;
            ajax("DELETE", "/cart-delete", { "beerID": beerID });
        });
    });

    /*
    // Filter button
    $('#filterButton').on('click', function () {
        let filter1Value = $('#filter1').val();
        let filter2Value = $('#filter2').val();
        loadFilteredResults(filter1Value, filter2Value);
    });

     */


    setTimeout(function () {
        $('#customAlert').alert('close');
    }, 2000);
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

            let cartItemDeleteButton = newRow.querySelector(".cart-delete");
            cartItemDeleteButton.addEventListener("click", function (event) {
                event.preventDefault();
                let beerID = cartItem.beer_id;
                ajax("DELETE", "/cart-delete", { "beerID": beerID });
            });

            let quantityInput = newRow.querySelector(".beer-quantity-change");
            quantityInput.addEventListener("change", function (event) {
                event.preventDefault();
                let beerID = cartItem.beer_id;
                let newQuantity = quantityInput.value;
                ajax("POST", "/update-cart", { "beerID": beerID, "newQuantity": newQuantity });
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

/*
function loadFilteredResults(filter1, filter2) {
    $.ajax({
        method: 'GET',
        url: '/filtruj',
        data: {
            "filter1": filter1,
            "filter2": filter2
        },
        success: function (response) {
            $('#filteredResults').html(response);
        },
        error: function (error) {
            console.error('Chyba:', error);
        }
    });
}

 */

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
