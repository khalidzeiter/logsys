<?php
require_once '../inc/dbController.php';
require_once '../inc/validator.php';

// Create Editor Object
$editUser = new Users('', '', '', '', '');

if (isset($_POST['id']) && $_SESSION['privileges'] == 1) {
    $userId = $_POST['id'];
} else {
    $userId = $_SESSION['userID'];
}

// Get User Data By ID
$currentUser = $editUser->getByID($userId);

if (isset($_POST['editUser'])) {
    // Get POST Data
    $name = $_POST{'name'};
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $password = $_POST['password'];

    // Validate Data
    $validate = new Validator($name, $username, $email, $bio, $password);

    // Edit User Data
    $currentUser->name = $validate->name;
    $currentUser->username = strtolower($validate->username);
    $currentUser->email = $validate->email;
    $currentUser->bio = $validate->bio;
    $currentUser->passwd = sha1($validate->password);

    // Update User Data
    if ($currentUser->update()) {
        $_SESSION['name'] = $validate->name;
        $_SESSION['username'] = strtolower($validate->username);
        $_SESSION['email'] = $validate->email;
        $_SESSION['bio'] = $validate->bio;
        $_SESSION['password'] = sha1($validate->password);

        echo "User Updated Successfuly!";
    }
} else if (isset($_POST['banUser']) && $_SESSION['privileges'] == 1) {
    $banState = $_POST['state'] == 1 ? 0 : 1; // Toggle Ban State
    $currentUser->ban($banState);
    if ($banState == 1) {
        echo "User Banned Successfuly!";
    } else if ($banState == 0) {
        echo "User Released Successfuly!";
    }
} else if (isset($_POST['deleteUser']) && $_SESSION['privileges'] == 1) {
    if ($currentUser->delete()) {
        echo "User '" . $currentUser->username . "', Deleted Successfuly!";
    } else {
        echo "Cannot Delete '" . $currentUser->username . "'";
    }
} else if (isset($_POST['redirect'])) {
    echo Config::$site_root;
} else {
    $userId = $_SESSION['userID'];
}