function updateQuantity(change, quantityId, totalPriceId, unitPriceId) {
    const quantityInput = document.getElementById(quantityId);
    const unitPrice = parseFloat(
        document.getElementById(unitPriceId).innerText.replace("Rs ", "")
    );
    let quantity = parseInt(quantityInput.value) + change;
    if (quantity < 0) {
        quantity = 0;
    }
    quantityInput.value = quantity;
    document.getElementById(totalPriceId).innerText =
        "Rs " + (quantity * unitPrice).toFixed(2);
    updateCartTotal();
}

function updateTotalPrice(quantityId, totalPriceId, unitPriceId) {
    const quantity = parseInt(document.getElementById(quantityId).value);
    const unitPrice = parseFloat(
        document.getElementById(unitPriceId).innerText.replace("Rs ", "")
    );
    document.getElementById(totalPriceId).innerText =
        "Rs " + (quantity * unitPrice).toFixed(2);
    updateCartTotal();
}

let subTotal = 0;
function updateCartTotal() {
    const totalPrices = document.querySelectorAll("[id^=total-price-]");
    let cartTotal = 0;
    totalPrices.forEach((price) => {
        cartTotal += parseFloat(price.innerText.replace("Rs ", ""));
    });
    document.getElementById("total-cart-price").innerText =
        "Rs " + cartTotal.toFixed(2);
    subTotal = cartTotal;
}

function getCartDetails() {
    let cartDetails = [];
    let totalCartPrice = subTotal.toFixed(2);
    let shippingCharge = 400; //testing purpose
    let shippingCost = shippingCharge.toFixed(2);
    let calculateGrandTotal =
        parseFloat(shippingCost) + parseFloat(totalCartPrice);
    let grandTotal = calculateGrandTotal.toFixed(2);

    document.querySelectorAll('tr[id^="product-row-"]').forEach((row) => {
        let itemCode = row.querySelector('input[name="item_code"]').value;
        let quantity = row.querySelector('input[name="quantity"]').value;
        let itemName = row.querySelector('p[name="item_name"]').textContent;
        let price = row.querySelector('p[name="price"]').textContent;  
        let totalPrice = quantity*price;

        cartDetails.push({
            item_code: itemCode,
            quantity: quantity,
            item_name: itemName,
            total_price: totalPrice,
        });
    });

    return {
        cartDetails: cartDetails,
        totalCartPrice: totalCartPrice,
        shippingCost: shippingCost,
        grandTotal: grandTotal,
    };
}

function goToCheckout() {
    let cartDetails = getCartDetails();

    fetch(storeCartDetailsUrl, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            "Content-Type": "application/json",
        },
        body: JSON.stringify(cartDetails),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                window.location.href = cartCheckoutUrl;
            } else if (data.message == "no user") {
                Swal.fire({
                    icon: "error",
                    title: "User Not Found",
                    text: "Please login First.",
                    confirmButtonText: "OK",
                });
            } else if (data.message == "no cart") {
                Swal.fire({
                    icon: "error",
                    title: "Products Not Found",
                    text: "Please add products to cart.",
                    confirmButtonText: "OK",
                });
            }
        })
        .catch((error) => console.error("Error:", error));
}
