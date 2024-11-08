<?php
if (isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
}

