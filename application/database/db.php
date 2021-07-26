<?php

    $dsn = 'mysql:host=localhost:3306;dbname=ub2';

    $username = 'root';

    $password = '';

    $options = [];

    try {
        $connection = new PDO($dsn, $username, $password, $options);

    } catch(PDOException $e) {

    }


?>