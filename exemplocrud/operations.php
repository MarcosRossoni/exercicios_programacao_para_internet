<?php

require_once("PDO.php");

$q = $_REQUEST["q"];

$pdo = new usePDO();
$pdo->createDB();
$pdo->createTable();

switch ($q) {
    case "readPessoas":
        $result = $pdo->select("SELECT * FROM pessoa");
        print (json_encode($result->fetchAll()));
        break;
    case "update":
        $id = $_REQUEST["id"];
        $nome = $_REQUEST["nome"];
        $idade = $_REQUEST["idade"];
        $sexo = $_REQUEST["sexo"];
        $estado_civil = $_REQUEST["estado_civil"];
        $result = $pdo->update("UPDATE pessoa SET nome='$nome', idade='$idade', sexo='$sexo',
                  estado_civil='$estado_civil' WHERE id='$id'");
        echo "Registro id $id atualizado com sucesso";
        break;
    case "insert":
        $nome = $_REQUEST["nome"];
        $idade = $_REQUEST["idade"];
        $sexo = $_REQUEST["sexo"];
        $estado_civil = $_REQUEST["estado_civil"];
        $message = $pdo->insert("INSERT INTO pessoa (nome, idade, sexo, estado_civil, endereco, usuario, senha)
                    VALUES ('$nome', '$idade', '$sexo', '$estado_civil',
                            'Rua B n 02', 'José Vieira, '".sha1(456789).")");

        if ($message != null) {
            header("location: inserir.php?mesagem=$message");
        } else {
            header("location: inserir.php?mensagem=Registro inserido com sucesso");
        }
        break;
    case "delete":
        $id = $_REQUEST["id"];
        $pdo->delete("DELETE FROM pessoa WHERE id='$id'");
        echo "Registro deletado com sucesso";
        break;
}
