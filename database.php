<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=upb_bd_td_techno_web;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
