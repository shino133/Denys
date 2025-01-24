<?php
use App\Utils\Helpers\Link;
use App\Utils\Helpers\Script;
use App\Utils\Helpers\Title;

Title::set(content: APP_NAME.' - Settings');

Link::addStylesheet(href: '/style/settings.css');
Link::addStylesheet(href: '/style/forms.css');
Link::addStylesheet(href: '/style/media.css');

Script::addExternalScript(src: "/assets/js/menuToggle.js");
Script::addExternalScript(src: "/js/components/components.js");
