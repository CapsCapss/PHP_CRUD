<?php

  require 'database/db.php';

  $message = "";

  if (isset ($_POST['id']) && isset($_POST['last_name']) && isset($_POST['first_name']) && isset($_POST['course'])) {
    $id = $_POST['id'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $course = $_POST['course'];

    $sql = 'INSERT INTO students(ID, LAST_NAME, FIRST_NAME, COURSE) VALUES(:id, :last_name, :first_name, :course)';
    $statement = $connection->prepare($sql);

    if ($statement->execute([':id' => $id, ':last_name' => $last_name, ':first_name' => $first_name, ':course' => $course])) {
      $message = 'Data Inserted Successfully.';
    }
  }


  $sql = 'SELECT * FROM students';

  $statement = $connection->prepare($sql);

  $statement->execute();

  $students = $statement->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>

<style>
  body {
    padding-left: 200px;
    padding-right: 200px;
    padding-top: 50px;

  }
</style>
</head>
<body>

  <?php if(!empty($message)): ?>
    <div class="alert alert-success">
      <?= $message; ?>
    </div>
  <?php endif; ?>
  <form method="post">

    <div class="form-group">
      <input type="text" class="form-control input-lg" id="id" placeholder="ID" name="id"/>
    </div>

    <div class="form-group">
      <input type="text" class="form-control input-lg" id="last_name" placeholder="Last Name" name="last_name"/>
    </div>

    <div class="form-group">
      <input type="text" class="form-control input-lg" id="first_name" placeholder="First Name" name="first_name"/>
    </div>

    <div class="form-group">
      <input type="text" class="form-control input-lg" id="course" placeholder="Course" name="course"/> 
    </div>


    <button type="submit" class="btn btn-light">Save</button>
  </form>


    <h1 style="padding-top: 10px; font-weight: bold">Student List</h1>


    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Last Name</th>
          <th scope="col">First Name</th>
          <th scope="col">Course</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($students as $student): ?>
        <tr>
          <td><?= $student->ID; ?></td>
          <td><?= $student->LAST_NAME; ?></td>
          <td><?= $student->FIRST_NAME; ?></td>
          <td><?= $student->COURSE; ?></td>
          <td>
          <a href="views/updates.php?id=<?= $student->ID; ?>" class="btn btn-primary mr-2" style="margin-right: 10px">Update</a>
          <a onclick="return confirm('Are you sure you want to delete this entry?')" href="database/delete.php?id=<?= $student->ID; ?>" class="btn btn-danger">Delete</a>
        </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


</body>
</html>