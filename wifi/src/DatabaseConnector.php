<?php


/**
 * Class DatabaseConnector
 */
Class DatabaseConnector
{

    /**
     * @var PDO
     */
    private $pdo;
    /**
     * @var
     */
    private $data;

    /**
     *
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:dbname=rd;host=localhost", "root", "root");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }


    /**
     * @param $group
     * @return array
     */
    public function getStudents($group)
    {
        $sql = "SELECT users.id,users.username FROM users LEFT JOIN `more` ON users.id=`more`.user_id WHERE `more`.`group` = :group;";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':group', $group);
        $result->execute();
        $this->data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $this->data;
    }

    /**
     * @return array
     */
    public function getGroups()
    {
        $sql = "SELECT `group` FROM `more` GROUP BY `group`";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        $this->data = $result->fetchAll(PDO::FETCH_COLUMN);
        return $this->data;
    }

    /**
     * @param $studentId
     */
    function __call($name, $arguments)
    {

    }

    public function deleteStudent($studentId)
    {
        $sql = "DELETE FROM users WHERE id=:studentId";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':studentId', $studentId);
        $result->execute();
        $sql = "DELETE FROM `more` WHERE user_id=:studentId";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':studentId', $studentId);
        $result->execute();
    }

    public function getTarifs()
    {
        $sql = "SELECT tarif FROM tarifs";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        $this->data = $result->fetchAll(PDO::FETCH_COLUMN);
        return $this->data;
    }

    public function addStudent($student)
    {
        $sql = "SELECT * FROM users WHERE ((username = :username) AND (password = :password))";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':username', $student[1]);
        $result->bindParam(':password', $student[3]);
        $result->execute();
        $studentExists = $result->fetch(PDO::FETCH_COLUMN);
        if ($studentExists) {
            die();
        }
        $userId = $result->fetch(PDO::FETCH_COLUMN);
        $sql = "INSERT INTO users (username,password,`name`,val1) VALUES (:username,:password,:name,:tarif);";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':username', $student[1]);
        $result->bindParam(':password', $student[3]);
        $result->bindParam(':name', $student[2]);
        $result->bindParam(':tarif', $student[4]);
        $result->execute();
        $sql = "SELECT id FROM users WHERE ((username = :username) AND (password = :password))";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':username', $student[1]);
        $result->bindParam(':password', $student[3]);
        $result->execute();
        $userId = $result->fetch(PDO::FETCH_COLUMN);
        $sql = "INSERT INTO `more` (user_id,`group`) VALUES (:userId,:group);";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':userId', $userId);
        $result->bindParam(':group', $student[0]);
        $result->execute();
    }

}
