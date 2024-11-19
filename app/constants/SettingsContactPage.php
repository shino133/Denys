<?php
Title::set(APP_NAME . ' - Contact settings');

Link::addStylesheet("/public/style/settings.css");
Link::addStylesheet("/public/style/forms.css");
Link::addStylesheet("/public/style/media.css");

Script::addInlineScript(`
$("#menu-toggle").click(function (e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});
`, ['type' => 'text/javascript']);

Script::addExternalScript(src: "/public/js/components/components.js");