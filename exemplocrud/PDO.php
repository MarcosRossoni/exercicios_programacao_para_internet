<?php

class usePDO
{
    private $servername = "localhost";
//    private $servername = "localhost:8890";
    private $username = "root";
    private $password = "root";
    private $dbname = "meubanco";
    private $instance;

    function getInstance()
    {
        if (empty($this->instance)){
            $this->instance = $this->connection();
        }
        return $this->instance;
    }

    private function connection()
    {
        $con = null;
        try {
            $con = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username,$this->password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        }
        catch (PDOException $e)
        {
            return $con;
        }
    }

    function createDB()
    {

        $sql = "";
        try {
            $cnx = $this->getInstance();
            echo $cnx==null;
            if ($cnx===null){
                $cnx = new PDO("mysql:host=$this->servername", $this->username,$this->password);
                $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
            $cnx->exec($sql);
        }
        catch (PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function createTable()
    {
        $sql = "";
        try {
            $cnx = $this->getInstance();
            $sql = "CREATE TABLE IF NOT EXISTS pessoa(
                    id INT(6) AUTO_INCREMENT PRIMARY KEY,
                    nome VARCHAR(50) NOT NULL,
                    idade INTEGER(3) NOT NULL,
                    sexo VARCHAR(1) NOT NULL,
                    estado_civil VARCHAR(100),
                    endereco VARCHAR(50),
                    usuario VARCHAR(50),
                    senha VARCHAR(100)
            )";
            $cnx->exec($sql);
        }
        catch (PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function insert($sql)
    {
        echo $sql;
        try {
            $cnx = $this->getInstance();
            $error = $cnx->prepare($sql);

            $error->execute();
            echo 'Error occurred: ' .implode(":", $error->errorInfo());
            if ($error->errorCode() == 0) {
                return;
            }
            else{
                return "Falha ao Inserir dados";
            }
        }
        catch (PDOException $e)
        {
            return "Falha ao Inserir dados";
        }
    }

    function select($sql)
    {
        try {
            $cnx = $this->getInstance();
            $result = $cnx->query($sql);

            return $result;
        }
        catch (PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function update($sql)
    {
        try {
            $cnx = $this->getInstance();
            $result = $cnx->query($sql);

            return $result;
        }
        catch (PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function delete($sql)
    {
        try {
            $cnx = $this->getInstance();
            $result = $cnx->query($sql);

            return $result;
        }
        catch (PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
    }


}