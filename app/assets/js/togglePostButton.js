const postContainer = document.getElementById("post-container");

let offset = 1; // Khởi tạo offset
let isRenderDone = false;

document
  .getElementById("togglePostButton")
  .addEventListener("click", function () {
    const url = `post/new/${offset}`;
    Ajax.get(
      url,
      {},
      {
        dataType: "html", // Chỉ định kiểu dữ liệu trả về là HTML
        onSuccess: function (responseHtml) {
          // Tạo post-wrapper mới
          const newPostWrapper = document.createElement("div");
          newPostWrapper.id = `post-wrapper-${offset}`;

          if (isRenderDone) return;

          if (responseHtml.trim()) {
            newPostWrapper.innerHTML = responseHtml;
            postContainer.appendChild(newPostWrapper);
            offset++;
            return;
          }

          const hrElement = document.createElement("hr");
          postContainer.appendChild(hrElement);
          newPostWrapper.className = "alert text-center";
          newPostWrapper.innerHTML = "Đã hết bài viết";
          postContainer.appendChild(newPostWrapper);
          isRenderDone = true;
        },
        onError: function (jqXHR, textStatus, errorThrown) {
          console.error("Error loading new posts:", textStatus, errorThrown);
        },
      }
    );
  });
