const unitPrice = 1000;
const days = 30;

const quantityInput = document.getElementById("quantity_per_day");
const totalPriceInput = document.getElementById("totalPrice");

function calculateTotal(){

    let quantity_per_day = parseInt(quantityInput.value) || 0;

    if(quantity_per_day < 0){
        alert("Quantity cannot be negative. Resetting to 0.");
        quantity_per_day = 0;
        quantityInput.value = 0;
    }

    let totalPrice = unitPrice * quantity_per_day * days;
    totalPriceInput.value = totalPrice;

    if(totalPrice > 1000){
        alert("Congratulations! You are eligible for a gift coupon.");
    }
}
quantityInput.addEventListener("input", calculateTotal);