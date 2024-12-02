<?php
$hostname = "localhost";
$database = "banco";
$username = "root";
$password = "1234";

$conexao = new mysqli($hostname, $username, $password, $database);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}


?>