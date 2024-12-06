document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const inputs = form.querySelectorAll("input");

  // Regex tiêu chí
  const fullNameRegex = /^[\p{L}\s]+$/u;
  const usernameRegex = /^[a-z0-9._]+$/;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Hàm validate từng trường
  const validateField = (input) => {
    const name = input.name;
    const value = input.value.trim();
    const errorElement = document.getElementById(`error-${name}`);

    let errorMessage = "";

    if (name === "fullName") {
      if (!value) errorMessage = "Họ và tên không được để trống.";
      else if (!fullNameRegex.test(value))
        errorMessage = "Họ và tên chỉ chứa chữ cái và khoảng trắng.";
    }

    if (name === "email") {
      if (!value) errorMessage = "Email không được để trống.";
      else if (!emailRegex.test(value)) errorMessage = "Email không hợp lệ.";
    }

    if (name === "username") {
      if (!value) errorMessage = "Username không được để trống.";
      else if (!usernameRegex.test(value))
        errorMessage = "Username chỉ chứa chữ thường, số, dấu . hoặc _.";
    }

    // Hiển thị lỗi
    errorElement.innerText = errorMessage;

    // Trả về trạng thái hợp lệ
    return errorMessage === "";
  };

  // Thêm sự kiện vào các input
  inputs.forEach((input) => {
    input.addEventListener("input", () => validateField(input));
    input.addEventListener("blur", () => validateField(input));
  });

  // Ngăn submit nếu có lỗi
  form.addEventListener("submit", (event) => {
    let isValid = true;

    inputs.forEach((input) => {
      if (!validateField(input)) isValid = false;
    });

    if (!isValid) {
      event.preventDefault();
      alert("Vui lòng sửa các lỗi trước khi gửi.");
    }
  });
});
