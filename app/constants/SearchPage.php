<?php

use App\Utils\Helpers\Link;
use App\Utils\Helpers\Script;

Script::addExternalScript(src: "https://cdn.jsdelivr.net/npm/chart.js@2.8.0");
Script::addExternalScript(src: "/js/components/components.js");
Script::addExternalScript(src: "/js/app.js");

Script::addExternalScript(src: "/assets/js/menuToggle.js");
Script::addExternalScript(src: "/assets/js/imagePreview.js");
Script::addExternalScript(src: "/assets/js/togglePostButton.js");

Script::addExternalScript(src: "https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js", attributes: ['type' => 'text/javascript'], position: 'head');
Script::addExternalScript(src: "/js/load.js", attributes: ['type' => 'text/javascript'], position: 'head');
Script::addExternalScript(src: "/assets/js/highlightActiveLink.js", attributes: [], position: 'body');
Script::addExternalScript(src: "/assets/js/searchUser.js", attributes: [], position: 'body');

Link::addStylesheet(href: '/style/media.css');
Link::addStylesheet(href: '/style/chat.css');
Link::addStylesheet(href: "https://vjs.zencdn.net/7.4.1/video-js.css");
