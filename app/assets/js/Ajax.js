class Ajax {

  static baseUrl = null;

  // Gọi phương thức GET
  static get(url, params = {}, onSuccess = null, onError = null) {
    $.ajax({
      url: this.baseUrl + url,
      type: "GET", 
      data: params,
      dataType: "json",
      success: function (response) {
        if (onSuccess) onSuccess(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (onError) onError(jqXHR, textStatus, errorThrown);
      },
    });
  }

  // Gọi phương thức POST
  static post(url, data = {}, onSuccess = null, onError = null) {
    $.ajax({
      url: this.baseUrl + url,
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify(data),
      dataType: "json",
      success: function (response) {
        if (onSuccess) onSuccess(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (onError) onError(jqXHR, textStatus, errorThrown);
      },
    });
  }

  // Gọi phương thức PUT
  static put(url, data = {}, onSuccess = null, onError = null) {
    $.ajax({
      url: this.baseUrl + url,
      type: "PUT",
      contentType: "application/json",
      data: JSON.stringify(data),
      dataType: "json",
      success: function (response) {
        if (onSuccess) onSuccess(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (onError) onError(jqXHR, textStatus, errorThrown);
      },
    });
  }

  // Gọi phương thức DELETE
  static delete(url, data = {}, onSuccess = null, onError = null) {
    $.ajax({
      url: this.baseUrl + url,
      type: "DELETE",
      contentType: "application/json",
      data: JSON.stringify(data),
      dataType: "json",
      success: function (response) {
        if (onSuccess) onSuccess(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        if (onError) onError(jqXHR, textStatus, errorThrown);
      },
    });
  }
}
