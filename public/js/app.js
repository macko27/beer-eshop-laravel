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
            success: function () {
                location.reload();
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
        button.addEventListener("click", function (event) {
            event.preventDefault();
            let beerID = button.dataset.beerId;

            console.log(beerID);

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
            success: function () {
                location.reload();
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


document.addEventListener("DOMContentLoaded", function () {
    $('#filterButton').on('click', function () {
        let filter1Value = $('#filter1').val();
        let filter2Value = $('#filter2').val();
        // Ďalšie filtre...

        loadFilteredResults(filter1Value, filter2Value);
    });

    function loadFilteredResults(filter1, filter2) {
        $.ajax({
            method: 'GET',
            url: '/filtruj',
            data: {
                "filter1": filter1,
                "filter2": filter2
                // Ďalšie filtre...
            },
            success: function (response) {
                $('#filteredResults').html(response);
            },
            error: function (error) {
                console.error('Chyba:', error);
            }
        });
    }
});
