<?php

class Database
{

    public function connectDB()
    {
        require_once APP_PATH . '/vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::createImmutable(APP_PATH);
        $dotenv->safeLoad();

        try {
            $dbh = new PDO($_ENV['DBTYPE'].':host=' . $_ENV['DBHOST'] . ';dbname=' . $_ENV['DBNAME'], $_ENV['DBUSER'], $_ENV['DBPWD']);
            return $dbh;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage() . '<br/>');
        }
    }

    public function closeDB()
    {
        $dbh = null;
    }

    public function selectAll()
    {
        $dbh = $this->connectDB();

        $sql = "SELECT *  FROM user" ;
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        $this->closeDB();

        return $result;
    }

    public function selectEmail()
    {
        $dbh = $this->connectDB();

        $sql = "SELECT email  FROM user" ;
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        $this->closeDB();

        return $result;
    }

    public function selectPassword()
    {
        $dbh = $this->connectDB();

        $sql = "SELECT password  FROM user" ;
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        $this->closeDB();

        return $result;
    }

    public function insertUser($array){
        $dbh = $this->connectDB();


        $req = "INSERT INTO user 
            (prenom, nom, email, password, dateTime_current, 
             dateTime_last, nb_connexion)
             VALUES (:prenom, :nom,:email, :password,:dateTime_current, :dateTime_last, :nb_connexion );
             ";

        $stmt = $dbh->prepare($req);
        $stmt->bindParam(':prenom', $array['prenom']);
        $stmt->bindParam(':nom', $array['nom']);
        $stmt->bindParam(':email', $array['email']);
        $stmt->bindParam(':password', $array['password']);
        $stmt->bindParam(':dateTime_current', $array['dateTime_current']);
        $stmt->bindParam(':dateTime_last', $array['dateTime_last']);
        $stmt->bindParam(':nb_connexion', $array['nb_connexion']);
        $stmt->execute();

        $this->closeDB();

    }

}