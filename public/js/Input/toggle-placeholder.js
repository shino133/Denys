document.addEventListener("DOMContentLoaded", function () {
  // Chọn tất cả các input có class 'toggle-placeholder'
  const inputs = document.querySelectorAll(".toggle-placeholder");

  inputs.forEach((input) => {
    // Xử lý khi người dùng focus vào input
    input.addEventListener("focus", function () {
      if (this.value === "") {
        this.value = this.placeholder; // Chuyển placeholder thành value
      }
    });

    // Xử lý khi người dùng blur khỏi input
    input.addEventListener("blur", function () {
      if (this.value === this.placeholder) {
        this.value = ""; // Xóa value
      } else if (this.value === "") {
        this.placeholder = "";
      }
    });
  });
});
