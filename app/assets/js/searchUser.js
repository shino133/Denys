const searchForm = document.getElementById("search-form");
const searchFormBtn = document.getElementById("search-form-btn");
const kwInput = document.getElementById("search-input");
const cardContainer = document.getElementById("user-card-container");

searchFormBtn.addEventListener("click", function (e) {
  // Lấy giá trị từ input
  const kw = kwInput.value.trim();
  console.log("Keyword:", kw);

  // Gửi yêu cầu AJAX với lớp Ajax
  Ajax.post(
    "search/request", // URL
    { kw: kw }, // Dữ liệu gửi đi
    {
      onSuccess: function (response) {
        if (response.html) {
          // Chèn HTML vào container
          cardContainer.innerHTML = response.html;
        }

        if (response.json && response.json.message) {
          console.log("Message:", response.json.message);
        }

        console.log("Response:", response);
        
      },
      onError: function (jqXHR, textStatus, errorThrown) {
        console.error("Lỗi khi gửi yêu cầu:", textStatus, errorThrown);
      },
    }
  );
});
