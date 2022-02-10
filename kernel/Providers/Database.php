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

    public function getEmail($email)
    {
        $dbh = $this->connectDB();

        $sql = "SELECT *  FROM user WHERE email =:email" ;
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email);
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

        $S_password_hash = password_hash($array['password'], PASSWORD_BCRYPT);
        $stmt = $dbh->prepare($req);
        $stmt->bindParam(':prenom', $array['prenom']);
        $stmt->bindParam(':nom', $array['nom']);
        $stmt->bindParam(':email', $array['email']);
        $stmt->bindParam(':password', $S_password_hash);
        $stmt->bindParam(':dateTime_current', $array['dateTime_current']);
        $stmt->bindParam(':dateTime_last', $array['dateTime_last']);
        $stmt->bindParam(':nb_connexion', $array['nb_connexion']);
        $stmt->execute();

        $this->closeDB();
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

    public function insert($champ, $val){
        $req = "INSERT into mvc.user (:champ) values (:val);";
        $stmt = $this->_dbh->prepare($req);
        $stmt->bindParam(':champ', $champ);
        $stmt->bindParam(':val', $val);
        $stmt->execute();
    }

    public function incrementLoginTentative($id){
        $req = "update `user` set login_tentative = login_tentative +1 where id=:id";
        $stmt = $this->_dbh->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function setNullLoginTentative($id){
        $req = "update `user` set login_tentative = 0 where id=:id";
        $stmt = $this->_dbh->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getLoginTentative($id){
        $req = "select login_tentative from `user` where id=:id";
        $stmt = $this->_dbh->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

}