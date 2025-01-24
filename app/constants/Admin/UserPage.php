<?php
use App\Utils\Helpers\Script;
use App\Utils\Helpers\Title;

Title::set('User Manager - ' . APP_NAME);

Script::addExternalScript(src: '/public/js/Auth/validateForm.js');
Script::addExternalScript(src: '/public/js/Auth/togglePassword.js');