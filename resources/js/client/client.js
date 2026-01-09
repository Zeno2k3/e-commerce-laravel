import '../bootstrap.js';
import './cart.js'; // Import the cart logic

// Thêm đoạn này để xử lý năm ở Footer
document.addEventListener('DOMContentLoaded', function () {
 const yearDisplay = document.getElementById('current-year');
 if (yearDisplay) {
  yearDisplay.textContent = new Date().getFullYear();
 }
});
