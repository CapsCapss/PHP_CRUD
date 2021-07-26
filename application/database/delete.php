<?php
require 'db.php';

$id = $_GET['id'];

$sql = 'DELETE FROM students WHERE ID=:id';

$statement = $connection->prepare($sql);

if ($statement->execute([':id'=>$id])) {
    header("Location: /application");
}