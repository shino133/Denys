<?php

use App\Utils\Helpers\Script;
use App\Utils\Helpers\Title;

Title::set('User Manager - ' . APP_NAME);

Script::addExternalScript(src: '/assets/js/validEditUserForm.js');