<?php 
class DB{
    private static $conn = 'mysql:host=localhost;dbname=store';
    private static  $user = 'root';
    private static $pass = '1';

    private static $instance = null;

    private $connection = null;

    protected function __construct()
    {
        $this->connection = new \PDO(self::$conn,self::$user,self::$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::FETCH_ASSOC => true
        ]);
    }

    public static function getInstance():DB{
        if(null == self::$instance){
            self::$instance=new static();
        }
        return self::$instance;
    }

    public function __wakeup()
    {
        
    }

    public  function __clone()
    {
        
    }

    public static function connection(): \PDO{
        return static::getInstance()->connection;
    }

    public static function prepare($statement):\PDOStatement{
        return static::connection()->prepare($statement);
    }

}
?>