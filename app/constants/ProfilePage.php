<?php
use App\Utils\Helpers\Link;
use App\Utils\Helpers\Script;
use App\Utils\Helpers\Store;
use App\Utils\Helpers\Title;

Title::set(content: APP_NAME.' - Profile');

Link::addStylesheet(href: "/style/profile.css");
Link::addStylesheet(href: "/style/media.css");

Script::addExternalScript(src: "/js/load.js", attributes: ["type" => "text/javascript"], position: 'head');
Script::addExternalScript(src: "/assets/js/imagePreview.js");

Script::addExternalScript(src: "/js/app.js", attributes: [], position: 'body');
Script::addExternalScript(src: "/js/components/components.js", attributes: [], position: 'body');
Script::addExternalScript(src: "/assets/js/menuToggle.js");
Script::addExternalScript(src: "/assets/js/uploadAvatarProfile.js", attributes: [], position: 'body');
Script::addExternalScript(src: "/assets/js/uploadBannerProfile.js", attributes: [], position: 'body');
Script::addExternalScript(src: "/assets/js/highlightActiveLink.js", attributes: [], position: 'body');
Script::addExternalScript(src: "/assets/js/followButton.js", attributes: [], position: 'body');

Store::set('bodyClass', 'profile');
