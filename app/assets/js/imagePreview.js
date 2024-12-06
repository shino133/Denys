// Setup
const inputsId = ["postImage", "commentImage", "userImage"];
const imgId = {
  postImage: "imagePreview",
  commentImage: "commentImagePreview",
  userImage: "userImagePreview",
};

// Function
document.addEventListener("DOMContentLoaded", function () {
  inputsId.forEach((inputId) => {
    const inputElement = document.getElementById(inputId); // Lấy input theo ID
    const imgElement = document.getElementById(imgId[inputId]); // Lấy ảnh theo ID

    if (!inputElement || !imgElement) return;

    inputElement.addEventListener("change", function (event) {
      const file = event.target.files[0]; // Lấy file đầu tiên từ input
      if (file) {
        const reader = new FileReader(); // Tạo FileReader để đọc file

        reader.onload = function (e) {
          imgElement.src = e.target.result; // Đặt ảnh được load từ FileReader
          imgElement.style.display = "block"; // Hiển thị ảnh
        };

        reader.readAsDataURL(file); // Đọc file dưới dạng DataURL
      } else {
        imgElement.style.display = "none"; // Ẩn ảnh nếu không có file
      }
    });
  });
});
