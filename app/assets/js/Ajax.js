function errorHandler(jqXHR, textStatus, errorThrown) {
  console.error("Error Status:", textStatus);
  console.error("Error Thrown:", errorThrown);
  console.error("Response Text:", jqXHR.responseText);
}

const fullUrl = window.location.origin;

class Ajax {
  static baseUrl = fullUrl.endsWith("/") ? fullUrl : fullUrl + "/";

  static request(method, url, options = {}) {
    const {
      data = {}, // Dữ liệu gửi đi
      dataType = "json", // Kiểu dữ liệu trả về (json, html, text, xml, script, etc.)
      contentType = "application/json", // Kiểu dữ liệu gửi đi
      onSuccess = null,
      onError = null,
    } = options;

    $.ajax({
      url: this.baseUrl + url,
      type: method,
      data: method === "GET" ? data : JSON.stringify(data),
      dataType: dataType, // Kiểu dữ liệu trả về
      contentType: contentType, // Kiểu dữ liệu gửi đi
      success: function (response) {
        if (onSuccess) onSuccess(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (onError) onError(jqXHR, textStatus, errorThrown);
        errorHandler(jqXHR, textStatus, errorThrown);
      },
    });
  }

  static get(url, params = {}, options = {}) {
    this.request("GET", url, { data: params, ...options });
  }

  static post(url, data = {}, options = {}) {
    this.request("POST", url, { data, ...options });
  }

  static put(url, data = {}, options = {}) {
    this.request("PUT", url, { data, ...options });
  }

  static delete(url, data = {}, options = {}) {
    this.request("DELETE", url, { data, ...options });
  }
}
