<?php
require_once '../inc/config.php';

if (isset($_POST['logout'])) {
    $mySession->kill();
    echo "Logout Successfuly!";
} else if (isset($_POST['redirect'])) {
    echo Config::$site_root;
} else {
    return false;
}