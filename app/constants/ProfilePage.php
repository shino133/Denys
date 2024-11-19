<?php
Title::set(content: APP_NAME . ' - Profile');

Link::addStylesheet(href: "/public/style/profile.css");
Link::addStylesheet(href: "/public/style/media.css");

Script::addExternalScript(src: "/public/js/load.js", attributes: ["type" => "text/javascript"], position: 'head');

Script::addExternalScript(src: "/public/js/app.js", attributes: [], position: 'body');
Script::addExternalScript(src: "/public/js/components/components.js", attributes: [], position: 'body');
