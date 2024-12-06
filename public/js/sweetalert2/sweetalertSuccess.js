document.addEventListener("DOMContentLoaded", function () {
  // Lấy tất cả các phần tử có class "sweetalert-success"
  const elements = document.querySelectorAll(".sweetalert-success");

  elements.forEach((element) => {
    element.addEventListener("click", function (event) {
      event.preventDefault(); // Ngăn chặn hành động mặc định

      Swal.fire({
        title: "Xác nhận hành động",
        text: "Hãy chắc chắn hành động của bạn!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xác nhận",
      }).then((result) => {
        if (result.isConfirmed) {
          
          // Nếu là thẻ <a>, điều hướng đến URL
          if (element.tagName === "A") {
            window.location.href = element.href;
          }
          // Nếu là <form>, gửi form
          if (element.tagName === "FORM") {
            element.submit();
          } else if (element.tagName === "BUTTON" && element.closest("form")) {
            element.closest("form").submit();
          }
        }
      });
    });
  });
});
