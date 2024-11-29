function generateBreadcrumb() {
  const breadcrumbContainer = document.querySelector(".breadcrumb");
  if (!breadcrumbContainer) return;

  // Lấy đường dẫn URL hiện tại (bỏ query và hash)
  const currentPath = window.location.pathname;
  const segments = currentPath.split("/").filter((segment) => segment); // Tách các phần tử không rỗng

  breadcrumbContainer.innerHTML = ""; // Xóa nội dung cũ

  // Thêm mặc định phần tử Home
  const homeLi = document.createElement("li");
  homeLi.className = "breadcrumb-item text-sm";
  const homeLink = document.createElement("a");
  homeLink.className = "opacity-5 text-dark";
  homeLink.href = "/";
  homeLink.textContent = "Denys";
  homeLi.appendChild(homeLink);
  breadcrumbContainer.appendChild(homeLi);

  // Khởi tạo phần tử breadcrumb từ các segments
  let cumulativePath = "";
  segments.forEach((segment, index) => {
    cumulativePath += `/${segment}`;
    const isLast = index === segments.length - 1;

    const li = document.createElement("li");
    li.className = `breadcrumb-item text-sm ${
      isLast ? "text-dark active" : ""
    }`;
    if (isLast) {
      li.setAttribute("aria-current", "page");
      li.textContent = segment.charAt(0).toUpperCase() + segment.slice(1);
    } else {
      const a = document.createElement("a");
      a.className = "opacity-5 text-dark";
      a.href = cumulativePath;
      a.textContent = segment.charAt(0).toUpperCase() + segment.slice(1);
      li.appendChild(a);
    }

    breadcrumbContainer.appendChild(li);
  });

  // Quét qua tất cả các thẻ <a> trong nav-item
  const navLinks = document.querySelectorAll(".nav-item .nav-link");
  navLinks.forEach((link) => {
    const linkPath = link.getAttribute("href");
    if (currentPath.startsWith(linkPath)) {
      link.classList.add("active", "bg-gradient-dark", "text-white");
    } else {
      link.classList.remove("active", "bg-gradient-dark", "text-white");
    }
  });
}

// Gọi hàm khi trang tải
document.addEventListener("DOMContentLoaded", generateBreadcrumb);
