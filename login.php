<?php
require_once 'inc/dbController.php';
require_once 'inc/sessionController.php';

// Login User Class
class Login
{
    private $username;
    private $password;
    private $privilenges;
    private $userInfo;

    public function __construct($user, $pass, $privilege)
    {
        $this->username = $user;
        $this->password = $pass;
        $this->privilenges = $privilege;

        global $db;

        // Get User Info SQL Statement
        $sql = 'SELECT * FROM ' . Users::getTableName()
            . ' WHERE `username` = "' . $this->username
            . '" AND `passwd` = "' . $this->password . '"'
            . ' AND `privileges` = "' . $this->privilenges . '"';

        // Prepare Data & Execute
        $stmt = $db->prepare($sql);
        $stmt->execute();

        // Fetch User Info
        $this->userInfo = array_shift($stmt->fetchAll(PDO::FETCH_ASSOC));
        if (count($this->userInfo) > 0) {
            if ($this->userInfo['ban'] == 1) {
                echo "You Are Banned!";
            } else {
                // Fill Session Parameters with User Data
                $_SESSION['userID'] = $this->userInfo['id'];
                $_SESSION['name'] = $this->userInfo['name'];
                $_SESSION['username'] = $this->userInfo['username'];
                $_SESSION['email'] = $this->userInfo['email'];
                $_SESSION['bio'] = $this->userInfo['bio'];
                $_SESSION['password'] = $this->userInfo['passwd'];
                $_SESSION['privileges'] = $this->userInfo['privileges'];
                echo "Login Successfully!";
            }
        } else {
            echo "Worng Username or Password!";
        }
        return false;
    }
}

// Get POST Data
$username = strtolower(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
$password = sha1(filter_input(INPUT_POST, 'password'));
$privilege = filter_input(INPUT_POST, 'privilege');

// Login...
$login = new Login($username, $password, $privilege);
?>