<?php
require_once 'sessionController.php';

// Database Class Control
class DBConn extends PDO
{
    private $dsn;
    private $user;
    private $pass;
    private $options;

    public function __construct()
    {
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __set($prop, $val)
    {
        $this->$prop = $val;
    }

    public function connect()
    {
        parent::__construct($this->dsn, $this->user, $this->pass, $this->options);
    }
}

// Default Configurations Class Control
abstract class Config
{
	// Global Settings
    public static $site_title = "User Management System";				// Website Title
    public static $site_root = "";	// Website URL
	
	// Database Settings
	public static $db_host = "";	// Database Hostname
	public static $db_user = "";	// Database Username
	public static $db_pass = "";    // Database Password
	public static $db_name = "";    // Database Name
}

// Initialization Of Database Control Object
$db = new DBConn();

$db->dsn = "mysql://hostname= " . Config::$db_host . ";dbname=" . Config::$db_name; // Data Source Name
$db->user = Config::$db_user;
$db->pass = Config::$db_pass;
$db->options = array(			// PDO Options
    $db::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
);

// Connect to Database
try {
    $db->connect();
} catch (PDOException $e) {
    echo $e->getMessage();
}

// Session Start & Control
if ('' === session_id()) {
    $mySession = new MySessionHandler();
    $mySession->start();
} else if (!$mySession->isValidFingerPrint()) {
    $mySession->kill();
} else {
    return false;
}

?>