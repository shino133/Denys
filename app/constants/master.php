<?php
class Constants
{
  public static function baseTags()
  {
    // Font Poppins
    Link::addLink('stylesheet', 'https://fonts.googleapis.com/css?family=Poppins');

    // Font Awesome
    Link::addLink('stylesheet', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', [
      'integrity' => 'sha512-ZvHjXoebDRUrTnKh9WKpWV/A0Amd+fjub5TkBXrPxe5F7WfDZL0slJ6a0mvg7VSN3qdpgqq2y1blz06Q8W2Y8A==',
      'crossorigin' => 'anonymous',
      'referrerpolicy' => 'no-referrer'
    ]);
    Script::addExternalScript("https://kit.fontawesome.com/17a4e5185f.js", ["crossorigin" => "anonymous"], "head");

    // Thêm favicon
    Link::addLink('shortcut icon', 'public/logo/favicon.png', ['type' => 'image/png']);
  }

  public static function homePage()
  {
    self::baseTags();
  }

  public static function loginPage()
  {
    self::baseTags();
    Title::set(APP_NAME . ' - Login');

    //Meta tags
    Meta::setDescription("Experience social networking ");
    Meta::setKeywords("social networking");

    // Dark theme css
    Link::addStylesheet(BASE_URL . "public/style/lighttheme_css/light_style.css?t=" . time(), ["id" => "theme"]);

    Script::addExternalScript("public/js/passwordValidate.js");
    Script::addExternalScript("public/js/script.js");
  }
}