<?php

function getCn(){

    $user = 'root';
    $password = '';
    $db = 'mysql:host=localhost;dbname=app';
    $cn = new PDO($db, $user, $password);
    return $cn;
}