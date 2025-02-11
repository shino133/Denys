<?php

use App\Utils\Helpers\Link;
use App\Utils\Helpers\Title;

Link::addStylesheet(href: '/style/404.css');
Link::addLink(rel: 'icon', href: '/logo/favicon.png', attributes: ['type' => 'image/png']);

Title::set(content: APP_NAME.' | 404');