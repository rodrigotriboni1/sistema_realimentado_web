<?php
// CRITICAL: Atualize estas credenciais com os dados do seu banco na HostGator
$host = "localhost"; 
$dbname = "rodr1642_dinho"; 
$username = "rodr1642_nougenic"; 
$password = "8s7UTmd9Kc*o";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Definir timezone se necessário
    // date_default_timezone_set('America/Sao_Paulo');
} catch (PDOException $e) {
    die(json_encode(["error" => "Falha na conexão com o banco de dados: " . $e->getMessage()]));
}

