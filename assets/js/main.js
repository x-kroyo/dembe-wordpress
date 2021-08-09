/**
 * Creates vanilla js number input spinner
 * 
 */

// The input which contains inputs quantity
quantityInput = document.getElementById('p-quantity');
// Add one to quantity
addButton = document.getElementById('p-quantity-add')
// Minus one from quantity
minusButton = document.getElementById('p-quantity-minus')


// A functions which increase or decrease quantity value by {step} done

function increase_quanitity_value() {

    if (+quantityInput.value < +quantityInput.max && +quantityInput.value >= +quantityInput.min)
        quantityInput.value = +quantityInput.value + 1;

}

function decrease_quanitity_value() {
    if (+quantityInput.value <= +quantityInput.max && +quantityInput.value > +quantityInput.min)
        quantityInput.value = +quantityInput.value - 1;
}


addButton.addEventListener('click', e => increase_quanitity_value());
minusButton.addEventListener('click', e => decrease_quanitity_value());

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

