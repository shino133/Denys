// Hàm lấy giá trị query string từ URL
function getQueryParam(param) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(param);
}

// Hàm xóa query string khỏi URL
function removeQueryParams() {
  const url = new URL(window.location.href);
  url.search = ""; // Xóa toàn bộ query string
  window.history.replaceState({}, document.title, url.pathname); // Cập nhật URL mà không reload
}

// Hàm hiển thị thông báo dựa trên query string
(() => {
  const message = getQueryParam("msg");
  const status = getQueryParam("status");
  removeQueryParams();

  if (message && status) {
    Swal.fire({
      text: message.replace(/_/g, " "), // Thay dấu _ bằng dấu cách
      icon: status, // 'success', 'error', 'warning', 'info', hoặc 'question'
      confirmButtonColor: "#d35400",
      confirmButtonText: "OK",
    })
  }
})();
