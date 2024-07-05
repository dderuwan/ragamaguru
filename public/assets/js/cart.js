function updateQuantity(change, quantityId, totalPriceId, unitPriceId) {
  const quantityInput = document.getElementById(quantityId);
  const unitPrice = parseFloat(document.getElementById(unitPriceId).innerText.replace('Rs ', ''));
  let quantity = parseInt(quantityInput.value) + change;
  if (quantity < 0) {
    quantity = 0;
  }
  quantityInput.value = quantity;
  document.getElementById(totalPriceId).innerText = 'Rs ' + (quantity * unitPrice).toFixed(2);
  updateCartTotal();
}

function updateTotalPrice(quantityId, totalPriceId, unitPriceId) {
  const quantity = parseInt(document.getElementById(quantityId).value);
  const unitPrice = parseFloat(document.getElementById(unitPriceId).innerText.replace('Rs ', ''));
  document.getElementById(totalPriceId).innerText = 'Rs ' + (quantity * unitPrice).toFixed(2);
  updateCartTotal();
}

function updateCartTotal() {
  const totalPrices = document.querySelectorAll('[id^=total-price-]');
  let cartTotal = 0;
  totalPrices.forEach(price => {
    cartTotal += parseFloat(price.innerText.replace('Rs ', ''));
  });
  document.getElementById('total-cart-price').innerText = 'Rs ' + cartTotal.toFixed(2);
}


