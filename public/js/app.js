//import './bootstrap.js';

window.addEventListener('scroll', function () {
    let navbar = document.querySelector('.navbar');

    if (window.scrollY > 50) {
        navbar.classList.add('transparent');
    } else {
        navbar.classList.remove('transparent');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    let addToCartButton = document.querySelector(".container-beer .addToCart");
    if (addToCartButton) {
        addToCartButton.addEventListener("click", function () {
            let beerID = document.querySelector(".beerID").value;
            let quantity = document.getElementById("beerQuantity").value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/add-to-cart",
                data: {
                    "beerID": beerID,
                    "quantity": quantity
                },
                success: function (response) {
                    alert(response.message);
                },
                error: function (error) {
                    console.error("Error:", error);
                }
            });
        });
    }
})


document.addEventListener("DOMContentLoaded", function () {
    let quantityInputs = document.querySelectorAll(".beer-quantity-change");

    quantityInputs.forEach(function (input) {
        input.addEventListener("change", function () {
            let beerID = input.dataset.beerId;
            let newQuantity = input.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            updateCartQuantity(beerID, newQuantity);
        });
    });

    function updateCartQuantity(beerID, newQuantity) {
        $.ajax({
            method: "POST",
            url: "/update-cart",
            data: {
                "beerID": beerID,
                "newQuantity": newQuantity
            },
            error: function (error) {
                console.error("Error:", error);
            }
        });
    }
});


document.addEventListener("DOMContentLoaded", function () {
    let deleteButtons = document.querySelectorAll(".cart-delete");

    deleteButtons.forEach(function (button) {
        button.addEventListener("change", function () {
            let beerID = button.dataset.beerId;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            deleteCartItem(beerID);
        });
    });

    function deleteCartItem(beerID) {
        $.ajax({
            method: "DELETE",
            url: "/cart-delete",
            data: {
                "beerID": beerID
            },
            success: function (response) {
                alert(response.message);
            },
            error: function (error) {
                console.error("Error:", error);
            }
        });
    }
})

setTimeout(function() {
    $('#customAlert').alert('close');
}, 2000);


