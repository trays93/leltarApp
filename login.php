<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//session kezelés indítása
if (!session_id()) @session_start();

require './inc/database.php';

$mysqli = new mysqli(
        $database_settings["url"],
        $database_settings["username"],
        $database_settings["password"],
        $database_settings["database"]);

if ($mysqli->connect_errno) {
    //kiirom, hogy hiba történt
    print("Hiba uzenet!");
    //kilépek a program futásából, mivel nem megfelelő a kapcsolat, az oldal csak további hibákat generálna.
    exit();
}

//$mysqli->query("SET NAMES 'utf8'");

if(isset($_POST["username"])){
$username = $_POST["username"];
    if ($result = $mysqli->query(
            "SELECT id, email, password FROM user WHERE email = '".$username."'")) {
        if($result->num_rows == 1){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if($row["password"] == hash('sha256', $_POST["password"])){
            //if($row["password"] == $_POST["password"]){
                $_SESSION["userid"] = $row["id"];
            }
        }
    }
}
//átirányitás az index.php -re
header('Location: index.php');