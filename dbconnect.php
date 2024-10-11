<?php

try {
    $host = "localhost";
    $dbname = "myblog";
    $dbuser = "root";
    $dbpassword = "";

    //Data source name
    $dsn = "mysql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn,$dbuser,$dbpassword);

    //or

    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    // echo "connection sucess";

} catch (PDOException $e) {
    die("Connection fail:".$e->getMessage());
}
?>