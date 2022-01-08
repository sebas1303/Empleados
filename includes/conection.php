<?php
$servername = "localhost";
$database = "empresa_ZF";
$username = "Sebastian24";
$password = "1040870367";

//conexion a la base "trabajador"
try {
  $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
  //set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

  
} catch(PDOException $e) {
  echo "Conexion fallida: " . $e->getMessage();
}
?>