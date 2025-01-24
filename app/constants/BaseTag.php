<?php
// Title

use App\Utils\Helpers\Link;
use App\Utils\Helpers\Script;
use App\Utils\Helpers\Store;
use App\Utils\Helpers\Title;

Title::set(content: APP_NAME);

// Icon
Link::addLink(rel: 'icon', href: '/logo/logo-16x16.png', attributes: ['type' => 'image/png']);

// Font 
Link::addStylesheet(href: 'https://fonts.googleapis.com/css?family=Major+Mono+Display');

// Css
Link::addStylesheet(href: '/style/boxicons-2.1.4/css/boxicons.min.css');

Link::addStylesheet(href: '/style/bootstrap/bootstrap.min.css');
Link::addStylesheet(href: '/style/sweetalert2/sweetalert2.min.css');
Link::addStylesheet(href: '/style/style.css');
Link::addStylesheet(href: '/style/components.css');


// Core
Script::addExternalScript(src: "/js/sweetalert2/sweetalert2.all.min.js");
Script::addExternalScript(src: "/js/jquery/jquery-3.3.1.min.js");
Script::addExternalScript(src: "/js/popper/popper.min.js");
Script::addExternalScript(src: "/js/bootstrap/bootstrap.min.js");

Script::addExternalScript(src: "/js/sweetalert2/queryHandler.js");
Script::addExternalScript(src: "/js/sweetalert2/sweetalertSuccess.js");
Script::addExternalScript(src: "/assets/js/Ajax.js");
Script::addExternalScript(src: "/assets/js/likePost.js");

Store::set('bodyClass', 'newsfeed');