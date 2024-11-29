document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const inputs = form.querySelectorAll("input");

  // Regex tiêu chí
  const fullNameRegex =
    /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéìíòóôõùúăđĩũơƯăâêôơđửấầẫậắằặẳãễêểễêảủ ]+$/;
  const usernameRegex = /^[a-z0-9._]+$/;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Hàm validate từng trường
  const validateField = (input) => {
    const name = input.name;
    const value = input.value.trim();
    let errorMessage = null;
    const errorElement = document.getElementById(`error-${name}`);

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

    const isValid = errorMessage === null;
    errorElement.innerText = errorMessage;

    return [isValid, errorMessage]; // Hợp lệ
  };

  // Thêm sự kiện vào các input
  inputs.forEach((input) => {
    input.addEventListener("input", () => validateField(input));
    input.addEventListener("blur", () => validateField(input));
  });

  // Ngăn submit nếu có lỗi
  form.addEventListener("submit", (event) => {
    event.preventDefault(); // Ngăn gửi form mặc định

    let isValidForm = true;
    let errorMessageNofi = null;

    inputs.forEach((input) => {
      const [isValid, errorMessage] = validateField(input);
      if (isValid == false) {
        isValidForm = false;
        errorMessageNofi = errorMessage;
        return;
      }
    });

    if (isValidForm) {
      Swal.fire({
        icon: "success",
        title: "Đăng ký thành công!",
        text: "Thông tin của bạn đã hợp lệ.",
        confirmButtonText: "Hoàn tất",
      }).then(() => {
        form.submit(); // Gửi form nếu hợp lệ
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Lỗi nhập liệu",
        text: errorMessageNofi,
        confirmButtonText: "Đồng ý",
      });
    }
  });
});
