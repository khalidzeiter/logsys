<?php
require_once 'config.php';

// Database Controller Class
class DBController
{
    // Prepare User's Data Values
    protected function prepareValues(PDOStatement &$stmt)
    {
        foreach (static::$tableSchema as $col => $type) {
            @$stmt->bindParam(":{$col}", $this->$col, $type);
        }
    }

    // Bind SQL Parameters
    private function buildSQLParameters()
    {
        $sqlParams = '';
        foreach (static::$tableSchema as $col => $type) {
            $sqlParams .= $col . ' = :' . $col . ', ';
        }
        return trim($sqlParams, ', '); 
    }

    // Create User
    public function create()
    {
        global $db;

        // Create User SQL Statement
        $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . self::buildSQLParameters();

        // Prepare & Execute SQL Query
        $stmt = $db->prepare($sql);
        $this->prepareValues($stmt);
        return $stmt->execute();
    }

    public function update()
    {
        global $db;

        // Update User SQL Statement
        $sql = 'UPDATE ' . static::$tableName . ' SET ' . self::buildSQLParameters() . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};

        // Prepare & Execute SQL Query
        $stmt = $db->prepare($sql);
        $this->prepareValues($stmt);
        return $stmt->execute();
    }

    public function delete()
    {
        global $db;

        // Delete User SQL Statement
        $sql = 'DELETE FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};

        // Prepare & Execute SQL Query
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }

    public function ban($state)
    {
        global $db;

        // Update User SQL Statement
        $sql = 'UPDATE ' . static::$tableName . ' SET `ban` = ' . $state . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};

        // Prepare & Execute SQL Query
        $stmt = $db->prepare($sql);
        $this->prepareValues($stmt);
        return $stmt->execute();
    }

    public function getAll()
    {
        global $db;

        // Get All Users Data SQL Statement
        $sql = 'SELECT * FROM ' . static::$tableName;

        // Prepare & Execute SQL Query
        $stmt = $db->prepare($sql);
        return $stmt->execute() === true ? $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema)) : false;
    }

    public function getByID($id)
    {
        global $db;

        // Get User Data By ID SQL Statement
        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . ' = ' . $id;

        // Prepare & Execute SQL Query
        $stmt = $db->prepare($sql);
        if ($stmt->execute() === true) {
            $obj = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            return array_shift($obj);
        }
        return false;
    }
}

// Users Data Controller Class
class Users extends DBController
{
    private $name;
    private $username;
    private $email;
    private $bio;
    private $passwd;

    protected static $primaryKey = 'id';
    protected static $tableName = "users";
    public static $tableSchema = array(
        'name' => PDO::PARAM_STR,
        'username' => PDO::PARAM_STR,
        'email' => PDO::PARAM_STR,
        'bio' => PDO::PARAM_STR,
        'passwd' => PDO::PARAM_STR
    );

    public function __construct($name, $username, $email, $bio, $passwd)
    {
        $this->name = $name;
        $this->username = strtolower($username);
        $this->email = $email;
        $this->bio = $bio;
        $this->passwd = sha1($passwd);
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __set($prop, $value)
    {
        $this->$prop = $value;
    }

    public static function getTableName()
    {
        return self::$tableName;
    }
}

?>