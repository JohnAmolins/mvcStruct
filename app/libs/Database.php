<?php
# construct PDO database class that connects to database, creates prepared statements, binds values, returns rows and results

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $passwd = DB_PASSWD;
    private $dbname = DB_NAME;

    private $dbh;   // dbh - database handler; used when prepare statement
    private $statement;
    private $error;

    public function __construct(){
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname; // dsn - database source name

        $options = array(
            PDO::ATTR_PERSISTENT => true,  // persistent connection to DB
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  // error handling
        );

        # PDO instance in try-catch block
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->passwd, $options);

        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    
    # make the query
    public function query($sql){                          
        $this->statement = $this->dbh->prepare($sql);
    }
    
    # bind values - what the value is for params
    public function bind($params, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($params, $value, $type);
    }

    # execute the prepared statement
    public function execute(){
        return $this->statement->execute();
    }

    # get result set as array of objects - fetch ALL
    public function resultSet(){            
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    # get single record as object
    public function resultSingle(){        
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    # get row count
    public function rowCount(){ 
        return $this->statement->rowCount();
    }

}