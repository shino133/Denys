<?php
use App\Utils\Helpers\Link;
use App\Utils\Helpers\Script;
use App\Utils\Helpers\Title;

Title::set(APP_NAME.' - Contact settings');

Link::addStylesheet("/style/settings.css");
Link::addStylesheet("/style/forms.css");
Link::addStylesheet("/style/media.css");

Script::addInlineScript(`
$("#menu-toggle").click(function (e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});
`, ['type' => 'text/javascript']);

Script::addExternalScript(src: "/js/components/components.js");