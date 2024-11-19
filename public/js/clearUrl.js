function cleanUrl() {
  const url = new URL(window.location.href);

  const errorMessage = url.searchParams.get("errorMessage");
  if (errorMessage) {
    alert(errorMessage);
  }

  url.search = "";

  window.history.replaceState({}, document.title, url.toString());
}

cleanUrl();
