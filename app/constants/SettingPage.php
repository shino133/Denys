<?php
Title::set(content: APP_NAME . ' - Settings');

Link::addStylesheet(href: '/public/style/settings.css');
Link::addStylesheet(href: '/public/style/forms.css');
Link::addStylesheet(href: '/public/style/media.css');

Script::addExternalScript(src: "/assets/js/menuToggle.js");
Script::addExternalScript(src: "/public/js/components/components.js");
