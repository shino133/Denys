<?php
// Title
Title::set(content: APP_NAME);

// Icon
Link::addLink(rel: 'icon', href: '/public/logo/logo-16x16.png', attributes: ['type' => 'image/png']);

// Font 
Link::addStylesheet(href: 'https://fonts.googleapis.com/css?family=Major+Mono+Display');
Link::addStylesheet(href: "/public/style/boxicons.min.css");

// Css
Link::addStylesheet(href: 'https://cdn.jsdelivr.net/npm/boxicons@1.9.2/css/boxicons.min.css');

Link::addStylesheet(href: '/public/style/bootstrap/bootstrap.min.css');
Link::addStylesheet(href: '/public/style/sweetalert2/sweetalert2.min.css');
Link::addStylesheet(href: '/public/style/style.css');
Link::addStylesheet(href: '/public/style/components.css');


// Core
Script::addExternalScript(src: "/public/js/sweetalert2/sweetalert2.all.min.js");
Script::addExternalScript(src: "/public/js/jquery/jquery-3.3.1.min.js");
Script::addExternalScript(src: "/public/js/popper/popper.min.js");
Script::addExternalScript(src: "/public/js/bootstrap/bootstrap.min.js");

Script::addExternalScript(src: "/public/js/sweetalert2/queryHandler.js");