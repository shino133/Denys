const followButton = document.getElementById("followButton");
const followButtonIcon = document.getElementById("followButtonIcon");
const followSpan = followButton.querySelector("span");

const userName = followSpan.id.split("@").at(-1);

const urlFollow = `user/follow/request/@${userName}`;
const urlUnfollow = `user/unfollow/request/@${userName}`;

const isFollowing = () => {
  return followButton.classList.contains("followed");
}

const setFollowButton = (isFollowing) => {
  if (isFollowing) {
    followButtonIcon.className = "bx bx-check";
    followSpan.textContent = "Following";
    followButton.classList.add("followed");
  } else {
    followButtonIcon.className = "bx bx-plus";
    followSpan.textContent = "Follow";
    followButton.classList.remove("followed");
  }
};

const setFollowUrlRequest = (isFollowing) => {
  console.log(isFollowing ? urlUnfollow : urlFollow);
  
  return isFollowing ? urlUnfollow : urlFollow;
};

followButton.addEventListener("click", () => {
  const followingStatus = isFollowing();
  Ajax.post(
    setFollowUrlRequest(followingStatus),
    {},
    {
      onSuccess: function () {
        setFollowButton(!followingStatus);

        // Hiển thị thông báo bằng SweetAlert2
        Swal.fire({
          icon: "success",
          title: followingStatus ? "Đã bỏ theo dõi" : "Đã theo dõi",
        });
      },
      onError: function (jqXHR, textStatus, errorThrown) {
        // Hiển thị thông báo lỗi bằng SweetAlert2
        Swal.fire({
          icon: "error",
          title: "Failed",
          text: "Please try again.",
        });

        // Khôi phục lại class của icon
        setFollowButton(followingStatus);
      },
    }
  );
});
