<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body{
          margin: 50px;
        }
    </style>
</head>
<body>
    <a class="btn btn-primary" href="task/cu.php">Create task</a> 
    <a class="btn btn-primary" href="user/index.php"> Users</a> 
    <?php 
    require 'connect.php';
    $sql="SELECT * FROM TASKS";
    $tasks=$conn->query($sql);
    if($tasks->num_rows>0){
    ?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">description</th>
      <th scope="col">staff</th>
      <th scope="col">actions</th>

    </tr>
  </thead>
  <tbody>
    <?php 
    while($task= $tasks->fetch_assoc()){
        ?>
    <tr>
      <td><?php echo $task['id'] ?></td>
      <td><?php echo $task['name'] ?></td>
      <td><?php echo $task['description'] ?></td>
      <td>
        <?php 
        $task_id=$task['id'];
        $sql3="SELECT name FROM USERS  JOIN TASK_USER ON USERS.id=TASK_USER.user_id AND task_id='$task_id' ";
        $result=$conn->query($sql3);
        $i=1;
        while($row=$result->fetch_assoc()){
          echo $i.'_'.$row['name'].'<br>';
          $i++;
        }
        ?>
      </td>
      <td><a class="btn btn-primary" href="task/ud.php?box=update&id=<?php echo $task['id']?>" name="up">Update</a>
      <a class="btn btn-danger" href="task/ud.php?box=delete&id=<?php echo $task['id']?>" name="de">Delete</a>
    </td>
    </tr>
    <?php
    }}else{
        echo 'no tasks yet';
    }
    ?>
  </tbody>
</table>
</body>
</html>