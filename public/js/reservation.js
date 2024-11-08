console.log('hello!')

let booking_total = document.querySelector('#booking-total');
let booking_price = document.getElementById('booking-price');
let price = document.getElementById('price');

booking_total.addEventListener('input', ()=>{
    booking_price.value = parseInt(booking_total.value) * parseInt(price.value);
});