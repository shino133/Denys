document.addEventListener("DOMContentLoaded", function () {
  const togglePasswordButtons = document.querySelectorAll(".toggle-password");

  togglePasswordButtons.forEach((button) => {
    button.addEventListener("click", function () {
      // Tìm input nằm trong cùng .input-group
      const input = this.closest(".input-group").querySelector(
        "input[type='password'], input[type='text']"
      );
      if (input) {
        if (input.type === "password") {
          input.type = "text";
          this.textContent = "Ẩn"; // Thay đổi nút thành "Ẩn"
        } else {
          input.type = "password";
          this.textContent = "Hiện"; // Thay đổi nút thành "Hiện"
        }
      }
    });
  });
});
