<?php
Script::addExternalScript(src: "https://cdn.jsdelivr.net/npm/chart.js@2.8.0");
Script::addExternalScript(src: "/public/js/app.js");
Script::addExternalScript(src: "/public/js/components/components.js");


Script::addInlineScript(content: `
$("#menu-toggle").click(function (e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
  });`, attributes: ['type' => 'text/javascript']);


Script::addExternalScript(src: "https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js", attributes: ['type' => 'text/javascript'], position: 'head');
Script::addExternalScript(src: "/public/js/load.js", attributes: ['type' => 'text/javascript'], position: 'head');

Link::addStylesheet(href: '/public/style/media.css');
Link::addStylesheet(href: '/public/style/chat.css');
Link::addStylesheet(href: "https://vjs.zencdn.net/7.4.1/video-js.css");