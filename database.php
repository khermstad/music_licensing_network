<?php
$server='localhost';
$username='mln_admin';
$password='mln_admin';
$database='mln_db';

try{
   $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
}catch(PDOException $e){
    die("Connection failed: " . $e->getMessage());
}
?>