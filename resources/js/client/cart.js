document.addEventListener('DOMContentLoaded', function () {
 const form = document.getElementById('add-to-cart-form');

 if (form) {
  form.addEventListener('submit', function (e) {
   // 1. Ngăn load lại trang
   e.preventDefault();

   // 2. Lấy dữ liệu từ form
   const formData = new FormData(form);
   const url = form.getAttribute('action');

   // 3. Gửi Request ngầm (AJAX)
   fetch(url, {
    method: 'POST',
    headers: {
     'X-Requested-With': 'XMLHttpRequest', // Báo cho Laravel biết đây là AJAX
     'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
    },
    body: formData
   })
    .then(response => response.json()) // Mong đợi Server trả về JSON
    .then(data => {
     if (data.status === 'success') {
      // --- CẬP NHẬT GIAO DIỆN TẠI ĐÂY ---

      // Cập nhật số lượng trên header
      let cartCountElement = document.getElementById('cart-count');
      if (cartCountElement) {
       cartCountElement.innerText = data.total_items; // Số liệu thật từ Server

       // Hiệu ứng rung (tận dụng lại code cũ của bạn)
       cartCountElement.parentElement.classList.add('animate-bounce');
       setTimeout(() => {
        cartCountElement.parentElement.classList.remove('animate-bounce');
       }, 1000);
      }

      alert("Đã thêm vào giỏ thành công!");
     } else {
      alert("Có lỗi xảy ra: " + data.message);
     }
    })
    .catch(error => {
     console.error('Error:', error);
     alert("Lỗi hệ thống!");
    });
  });
 }
});
