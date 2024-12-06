function highlightActiveLink() {
  const currentUrl = window.location.pathname;
  const links = document.querySelectorAll(".profile-links a");

  links.forEach((link) => {
    // Kiểm tra nếu URL của thẻ <a> trùng với URL hiện tại
    if (link.getAttribute("href") === currentUrl) {
      // Thêm class 'active' vào phần tử <li> chứa thẻ <a>
      link.closest(".list-inline-item").classList.add("active");
    }
  });
}

// Gọi hàm khi trang tải
highlightActiveLink();
