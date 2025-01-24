<?php
use App\Utils\Helpers\Link;
use App\Utils\Helpers\Meta;
use App\Utils\Helpers\Script;
use App\Utils\Helpers\Title;

// Login Page Constants
Title::set(APP_NAME.' - Login');

//Meta tags
Meta::setDescription("Experience social networking ");
Meta::setKeywords("social networking");

// Dark theme css
Link::addStylesheet(href: '/style/auth.css');
Link::addStylesheet(href: '/style/forms.css');
Link::addStylesheet(href: '/style/media.css');

Script::addExternalScript(src: '/js/Auth/validateForm.js');
Script::addExternalScript(src: '/js/Auth/togglePassword.js');
