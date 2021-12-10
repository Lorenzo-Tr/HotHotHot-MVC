<?php
require_once APP_PATH . '/vendor/autoload.php';

class Database
{
    private $_dbh = null;
    private static $_instance ;

    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(APP_PATH);
        $dotenv->safeLoad();
        try {
            $this->_dbh = new PDO($_ENV['DBTYPE'] . ':host=' . $_ENV['DBHOST'] . ';dbname=' . $_ENV['DBNAME'], $_ENV['DBUSER'], $_ENV['DBPWD']);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage() . '<br/>');
        }
    }

    public static function getInstance(){
        if(is_null(self::$_instance))
        {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    public function selectAll()
    {
        $sql = "SELECT *  FROM user";
        $stmt = $this->_dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);


        return $result;
    }

    public function getEmail($email)
    {

        $sql = "SELECT *  FROM user WHERE email =:email";
        $stmt = $this->_dbh->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);


        return $result;
    }


    public function addUser($array)
    {


        $req = "INSERT INTO user 
            (prenom, nom, email, password, dateTime_current, 
             dateTime_last, nb_connexion)
             VALUES (:prenom, :nom,:email, :password,:dateTime_current, :dateTime_last, 0 );
             ";

        $S_password_hash = password_hash($array['password'], PASSWORD_BCRYPT);
        $stmt = $this->_dbh->prepare($req);
        $stmt->bindParam(':prenom', $array['prenom']);
        $stmt->bindParam(':nom', $array['nom']);
        $stmt->bindParam(':email', $array['email']);
        $stmt->bindParam(':password', $S_password_hash);
        $stmt->bindParam(':dateTime_current', $array['dateTime_current']);
        $stmt->bindParam(':dateTime_last', $array['dateTime_last']);
        $stmt->execute();

    }

    public function loginNow($id)
    {

        $req = "UPDATE mvc.`user` SET dateTime_current=now() WHERE id=:id;
                UPDATE user SET nb_connexion = nb_connexion + 1 WHERE id=:id  ";
        $stmt = $this->_dbh->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }


    public function logout($id)
    {
        $req = "UPDATE mvc.`user` SET dateTime_last=now() WHERE id=:id; ";
        $stmt = $this->_dbh->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }

}