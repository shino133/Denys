(() => {
  const url = new URL(window.location.href);
  const msgs = ["notification", "errorMessage"];

  msgs.forEach((msg) => {
    const errorMessage = url.searchParams.get("msg");
    if (errorMessage) {
      alert(errorMessage);
    }
  });

  url.search = "";
  window.history.replaceState({}, document.title, url.toString());
})();
