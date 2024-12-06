// Lấy các phần tử cần thiết
const bannerInput = document.getElementById("banner");
const bannerImage = document.querySelector(".profile-cover img");
let defaultBanner = bannerImage.src; // URL của ảnh banner mặc định
let tempBannerUrl = ""; // URL tạm thời của ảnh banner

// Lắng nghe sự kiện thay đổi file
bannerInput.addEventListener("change", function (event) {
  const file = event.target.files[0];

  if (file && file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.onload = function (e) {
      tempBannerUrl = e.target.result; // Lưu URL tạm thời

      // Cập nhật ảnh banner tạm thời
      bannerImage.src = tempBannerUrl;

      // Hiển thị hộp thoại xác nhận
      setTimeout(() => {
        Swal.fire({
          title: "Xác nhận thay đổi ảnh bìa",
          text: "Bạn có muốn cập nhật ảnh bìa này không?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Xác nhận",
          cancelButtonText: "Hủy",
          timer: 5000,
          timerProgressBar: true,
        }).then((result) => {
          if (result.isConfirmed) {
            // Submit form khi người dùng xác nhận
            const form = document.querySelector(".profile-cover");
            form.submit();
          } else {
            // Reset banner về trạng thái ban đầu nếu người dùng hủy
            resetBanner();
          }
        });
      }, 1000); // 1 giây để hiển thị hộp thoại
    };

    reader.readAsDataURL(file);
  } else {
    Swal.fire("Lỗi", "Vui lòng chọn một tệp ảnh hợp lệ!", "error");
    resetBanner();
  }
});

// Hàm khôi phục ảnh bìa về trạng thái mặc định
function resetBanner() {
  bannerInput.value = ""; // Xóa file trong input
  tempBannerUrl = ""; // Xóa URL tạm thời
  bannerImage.src = defaultBanner; // Khôi phục ảnh bìa cũ
}
