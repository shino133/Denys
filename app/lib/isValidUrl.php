<?php
function isValidUrl($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}
