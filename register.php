<?php
require_once 'inc/dbController.php';
require_once 'inc/validator.php';

// Get POST Data
$name = $_POST{'name'};
$username = $_POST['username'];
$email = $_POST['email'];
$bio = $_POST['bio'];
$password = $_POST['password'];

// Validate Data
$validate = new Validator($name, $username, $email, $bio, $password);

// Create a New User
$register = new Users($validate->name, $validate->username, $validate->email, $validate->bio, $validate->password);
if ($register->create()) {
    echo "User Created Successfuly!";
}

?>