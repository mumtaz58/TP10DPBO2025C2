<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "college";
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                "mysql:host=$this->host;dbname=$this->database",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }

    public function executeQuery($query, $params = [])
    {
        try {
            $stmt = $this->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }

    public function fetchAll($query, $params = [])
    {
        $stmt = $this->executeQuery($query, $params);
        return $stmt->fetchAll();
    }

    public function fetch($query, $params = [])
    {
        $stmt = $this->executeQuery($query, $params);
        return $stmt->fetch();
    }

    public function rowCount($query, $params = [])
    {
        $stmt = $this->executeQuery($query, $params);
        return $stmt->rowCount();
    }
}