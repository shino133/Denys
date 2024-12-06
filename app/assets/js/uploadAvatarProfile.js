const profileAvatar = document.getElementById("profileAvatar");
const fileInput = document.getElementById("updateProfilePicInput");
const fullNameElement = document.getElementById("profileFullName");

const requestUrl = "/user/profile/avatar/upload/request";
const timeOut = 1; //seconds

let defaultAvatar = "/public/img/users/user-10.png";
let tempImageUrl = ""; // URL tạm thời của ảnh

fileInput.addEventListener("change", function (event) {
  const file = event.target.files[0];

  if (file && file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.onload = function (e) {
      const tempImageUrl = e.target.result;

      if (profileAvatar.tagName === "IMG") {
        defaultAvatar = profileAvatar.src;
        profileAvatar.src = tempImageUrl;
      } else {
        profileAvatar.innerHTML = `<img src="${tempImageUrl}" class="avatar img-circle" id="profileAvatar"/>`;
      }

      setTimeout(() => {
        Swal.fire({
          title: "Xác nhận thay đổi ảnh đại diện",
          text: "Bạn có muốn cập nhật ảnh đại diện này không?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Xác nhận",
          cancelButtonText: "Hủy",
          timer: 5000,
          timerProgressBar: true,
        }).then((result) => {
          if (result.isConfirmed) {
            // Submit the form when confirmed
            const form = document.getElementById("updateProfilePicForm");
            form.submit();
          } else {
            // Reset avatar if cancelled
            resetAvatar();
          }
        });
      }, timeOut * 1000);
    };

    reader.readAsDataURL(file);
  } else {
    Swal.fire("Lỗi", "Vui lòng chọn một tệp ảnh hợp lệ!", "error");
    resetAvatar();
  }
});


// Hàm khôi phục ảnh đại diện cũ
function resetAvatar() {
  fileInput.value = ""; // Reset input file
  tempImageUrl = "";

  // Lấy chữ cái đầu tiên từ tên trong thẻ #profileFullName
  const fullName = fullNameElement ? fullNameElement.textContent.trim() : "";
  const initial = fullName ? fullName.charAt(0).toUpperCase() : "A"; // Mặc định là 'A' nếu không có tên

  // Kiểm tra nếu thẻ profileAvatar là IMG
  if (profileAvatar.tagName === "IMG") {
    profileAvatar.src = defaultAvatar;
  } else {
    // Nếu không phải thẻ IMG, khôi phục dạng HTML ban đầu
    profileAvatar.innerHTML = `
      <div class="d-flex justify-content-center align-items-center bg-orange text-white avatar img-circle" 
           style="height: 150px; width: 150px; font-size: 50px;">
        <span>${initial}</span>
      </div>`;
  }
}
