export function addToCartDemo(e) {
 // 1. Ngăn chặn hành vi mặc định (tránh load lại trang)
 if (e) {
  e.preventDefault();
  e.stopPropagation();
 }

 // 2. Tìm số lượng trên Header
 let cartCountElement = document.getElementById('cart-count');

 // 3. Kiểm tra xem có tìm thấy không
 if (cartCountElement) {
  // Lấy số cũ + 1
  let currentCount = parseInt(cartCountElement.innerText);
  cartCountElement.innerText = currentCount + 1;

  // Hiệu ứng rung nhẹ
  cartCountElement.parentElement.classList.add('animate-bounce');
  setTimeout(() => {
   cartCountElement.parentElement.classList.remove('animate-bounce');
  }, 1000);

  // Thông báo (Dùng alert hoặc console.log để test)
  console.log("Đã thêm vào giỏ hàng!");
  // alert("Đã thêm sản phẩm vào giỏ hàng!"); // Bỏ comment dòng này nếu muốn hiện popup
 } else {
  console.error("LỖI: Không tìm thấy id='cart-count'. Kiểm tra file Header!");
  alert("Lỗi: Chưa tìm thấy icon giỏ hàng có id='cart-count'.");
 }
}

// Make it available globally if needed, or just attach to window
window.addToCartDemo = addToCartDemo;
