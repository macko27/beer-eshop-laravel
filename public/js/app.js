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
            let quantitty = document.getElementById("beerQuantity").value;

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
                    "quantity": quantitty
                },
                success: function (response) {
                    alert(response.message);
                }
            });
        });
    }
})



