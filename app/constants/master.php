<?php
class Constants
{
  public static function home()
  {
    Link::addLink('stylesheet', 'https://fonts.googleapis.com/css?family=Poppins');

    // Thêm Font Awesome với các thuộc tính bổ sung
    Link::addLink('stylesheet', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', [
      'integrity' => 'sha512-ZvHjXoebDRUrTnKh9WKpWV/A0Amd+fjub5TkBXrPxe5F7WfDZL0slJ6a0mvg7VSN3qdpgqq2y1blz06Q8W2Y8A==',
      'crossorigin' => 'anonymous',
      'referrerpolicy' => 'no-referrer'
    ]);

    Link::addStylesheet("style/lighttheme_css/light_style.css?t=" . time(), ["id" => "theme"]);

    // Thêm favicon
    Link::addLink('shortcut icon', 'public/logo/denys.svg', ['type' => 'image/png']);
  }
}