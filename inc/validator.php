<?php

// Input Data Validator Class
class Validator
{
    private $name;
    private $username;
    private $email;
    private $bio;
    private $password;

    public function __construct($name, $username, $email, $bio, $password)
    {
        if (isset($name)) {
            if (strlen($name) > 5 && strlen($name) < 50) {
                $this->name = filter_var($name, FILTER_SANITIZE_STRING);
            } else {
                echo "Please, Enter your Name!";
                return false;
            }
        }
        if (isset($username)) {
            if (strlen($username) > 4 && strlen($username) < 15) {
                $this->username = filter_var($username, FILTER_SANITIZE_STRING);
            } else {
                echo "Please, Enter your Username!";
                return false;
            }
        }
        $this->bio = isset($bio) ? filter_var($bio, FILTER_SANITIZE_STRING) : '';
        if (isset($password)) {
            if (strlen($password) > 5 && strlen($password) < 15) {
                $this->password = $password;
            } else {
                echo "Please, Enter your Password!";
                return false;
            }
        }
        if (isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
        } else {
            echo "Please, Enter your Email!";
            return false;
        }
    }

    public function __get($prop)
    {
        return $this->$prop;
    }
}
