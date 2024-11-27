// Setup
const inputsId = ["postImage", "commentImage"];
const imgId = {
  postImage: "imagePreview",
  commentImage: "commentImagePreview",
};

// Function
$(document).ready(function () {
  inputsId.forEach((inputId, index) => {
    if (!$("#" + inputId)) return;
    $("#" + inputId).on("change", function (event) {
      const file = event.target.files[0]; // Lấy file đầu tiên từ input
      if (file) {
        const reader = new FileReader(); // Tạo FileReader để đọc file

        reader.onload = function (e) {
          $("#" + imgId[inputId])
            .attr("src", e.target.result) // Đặt ảnh được load từ FileReader
            .show(); // Hiển thị ảnh
        };

        reader.readAsDataURL(file); // Đọc file dưới dạng DataURL
      } else {
        $("#" + imgId).hide(); // Ẩn ảnh nếu không có file
      }
    });
  });
});
