<?php
try {
    // $varibale=new PDO("url,user,password");
    $baserestau = new PDO('mysql:host=kahinabase;port=3306;dbname=restaurant; charset=utf8', 'root', 'kahina');
} catch (Exception $e) {
    die('<p style="color: red;">connexion échouée</p>' . $e->getMessage());
}
