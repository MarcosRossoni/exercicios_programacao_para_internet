<?php

require_once "PDO.php";

$pdo = new usePDO();
$pdo->createDB();
$pdo->createTable();

print ($pdo->insert("INSERT INTO pessoa (nome, idade, sexo, estado_civil, endereco, usuario, senha) 
                        VALUES ('carlos', 30, 'M', 'solteiro', 'rua B n 01', 'cpelegrin', '".sha1(123456)."')")
    . "<br>");

print ($pdo->insert("INSERT INTO pessoa (nome, idade, sexo, estado_civil, endereco, usuario, senha) 
                        VALUES ('marcos', 30, 'M', 'casado', 'rua C n 01', 'marcosa', '".sha1(123456)."')")
    . "<br>");

print ($pdo->insert("INSERT INTO pessoa (nome, idade, sexo, estado_civil, endereco, usuario, senha) 
                        VALUES ('ana', 37, 'F', 'casada', 'rua D n 01', 'anam', '".sha1(123456)."')")
    . "<br>");

print ($pdo->insert("INSERT INTO pessoa (nome, idade, sexo, estado_civil, endereco, usuario, senha) 
                        VALUES ('joao', 12, 'M', 'solteiro', 'rua E n 01', 'joaoq', '".sha1(123456)."')")
    . "<br>");