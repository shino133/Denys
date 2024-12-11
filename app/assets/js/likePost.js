$(document).ready(function () {
  let likeTimeout = {}; // Theo dõi timeout riêng cho từng nút
  const timeDelay = 1000; // 1s
  const addUrl = "like/request/add/";
  const deleteUrl = "like/request/destroy/";

  $(".like-btn").on("click", function () {
    const button = $(this);
    const classLiked = "active";
    const postId = button.attr("id").split("-").pop();
    const isActive = button.hasClass(classLiked);
    const likeCountSpan = button.find(".like-count");
    let likeCount = parseInt(likeCountSpan.text(), 10);

    // Thay đổi giao diện tức thì
    if (isActive) {
      button.removeClass(classLiked);
      likeCountSpan.text(--likeCount);
    } else {
      button.addClass(classLiked);
      likeCountSpan.text(++likeCount);
    }

    // Xóa timeout trước đó nếu có
    if (likeTimeout[postId]) clearTimeout(likeTimeout[postId]);

    // Đặt timeout mới để gửi API sau 1 giây
    // likeTimeout[postId] = setTimeout(() => {
    if (button.hasClass(classLiked)) {
      // Nếu nút active -> Gửi POST
      Ajax.post(
        addUrl + postId,
        {},
        function (response) {
          console.log("Like added:", response);
        },
        function (jqXHR, textStatus, errorThrown) {
          console.error("Error Status:", textStatus);
          console.error("Error Thrown:", errorThrown);
          console.error("Response Text:", jqXHR.responseText);
        }
      );
    } else {
      // Nếu nút không active -> Gửi DELETE
      Ajax.delete(
        deleteUrl + postId,
        {},
        {
          onSuccess: function (response) {
            console.log("Like removed:", response);
          },
          onError: function (jqXHR, textStatus, errorThrown) {
            console.error("Error Status:", textStatus);
            console.error("Error Thrown:", errorThrown);
            console.error("Response Text:", jqXHR.responseText);
          },
        }
      );
    }
    // }, timeDelay);
  });
});
