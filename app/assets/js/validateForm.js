document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const inputs = form.querySelectorAll("input");

  // Regex tiêu chí
  const fullNameRegex =
    /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯăâêôơđửấầẫậắằặẳãễêểễêảủ ]+$/;
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

    if (name === "password") {
      if (!value) errorMessage = "Mật khẩu không được để trống.";
      else if (value.length < 8)
        errorMessage = "Mật khẩu phải có ít nhất 8 ký tự.";
    }

    if (name === "confirmPassword") {
      const password = form
        .querySelector("input[name='password']")
        .value.trim();
      if (!value) errorMessage = "Xác nhận mật khẩu không được để trống.";
      else if (value !== password)
        errorMessage = "Mật khẩu xác nhận không khớp.";
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
 