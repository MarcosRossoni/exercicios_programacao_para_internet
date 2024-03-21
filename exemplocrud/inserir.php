<?php
require_once ("menu.php");
require_once ("forminsert.php");

if (isset($_GET["menssagem"])) {
    $format_mensagem = '<div>Mensagem: %s</div>';
    printf($format_mensagem, $_GET["mensagem"]);
}