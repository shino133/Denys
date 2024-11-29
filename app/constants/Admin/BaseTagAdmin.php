<?php
// Title
Title::set(content: APP_NAME . ' - Admin');

// Icons
Link::addLink(rel: 'icon', href: '/public/logo/logo-16x16.png', attributes: ['type' => 'image/png']);
Link::addLink(rel: 'apple-touch-icon', href: '/public/logo/logo-64x64.png', attributes: ['sizes' => '64x64']);

// Fonts
Link::addStylesheet(href: "https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900", attributes: ['type' => 'text/css']);
Script::addExternalScript(src: "https://kit.fontawesome.com/42d5adcbca.js", attributes: ['crossorigin' => "anonymous"], position: 'head');

// Nucleo Icons
Link::addStylesheet(href: "/public/style/nucleo-icons.css");
Link::addStylesheet(href: "/public/style/nucleo-svg.css");

// Material Icons
Link::addStylesheet(href: "https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0");


// Css
Link::addStylesheet(href: '/public/style/material-dashboard.css?v=3.2.0"', attributes: ['id' => 'pagestyle']);

// Core
Script::addExternalScript(src: "/public/js/core/popper.min.js");
Script::addExternalScript(src: "/public/js/core/bootstrap.min.js");
Script::addExternalScript(src: "/public/js/plugins/perfect-scrollbar.min.js");
Script::addExternalScript(src: "/public/js/plugins/smooth-scrollbar.min.js");

Script::addInlineScript(`
const win = navigator.platform.indexOf("Win") > -1;
if (win && document.querySelector("#sidenav-scrollbar")) {
  const options = {
    damping: "0.5",
  };
  Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
}
`);

Script::addExternalScript(src: "https://buttons.github.io/buttons.js", attributes: ['async' => null, 'defer' => null]);
Script::addExternalScript(src: "/public/js/material-dashboard.min.js?v=3.2.0");
Script::addExternalScript(src: "/assets/js/generateBreadcrumb.js");

Store::set('bodyClass', 'g-sidenav-show bg-gray-100');
